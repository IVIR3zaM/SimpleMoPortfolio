<?php
namespace IVIR3zaM\SimpleMoPortfolio\Threads;

class Manager implements ManagerInterface
{
    /**
     * @var int The maximum load percentage permitted
     */
    protected $maxLoad;

    /**
     * @var int The micro seconds for wait after an async command runs
     */
    protected $sleep;

    /**
     * @var int number of CPUs
     */
    static protected $CPUs;

    /**
     * @param int $maxLoad The maximum load permitted percentage
     * @param int $sleep The micro seconds for wait after an async command runs
     */
    public function __construct($maxLoad = 100, $sleep = 1000)
    {
        $this->setMaxLoad($maxLoad);
    }

    /**
     * Set the maximum load permitted for running a single command.
     * a number between 0 and 10,000 percentage
     * @param int $load
     * @return $this
     */
    public function setMaxLoad($load)
    {
        $load = abs(intval($load));
        if ($load > 10000) {
            $load = 10000;
        }
        $this->maxLoad = $load;
        return $this;
    }

    /**
     * Set the micro seconds for wait after an async command runs
     * @param int $sleep
     * @return $this
     */
    public function setSleep($sleep)
    {
        $this->sleep = abs(intval($sleep));
        return $this;
    }

    /**
     * Get the micro seconds for wait after a command runs
     * @return int
     */
    public function getSleep()
    {
        return $this->sleep;
    }

    /**
     * Get the maximum load permitted
     * @return int
     */
    public function getMaxLoad()
    {
        return $this->maxLoad;
    }

    /**
     * Run a command to reach the maximum load permitted
     * @param string $command
     * @param int $maxRepeat The maximum number of times that the command repeated
     * @return int|false The number of times that command runs
     * @todo must implement running command async on windows too
     */
    public function runCommand($command, $maxRepeat = 0)
    {
        if (!$command) {
            return false;
        }
        $command .= '> /dev/null 2>&1 &';
        $loop = 0;
        $maxRepeat = abs(intval($maxRepeat));
        while (static::getLoadPercentage() < $this->getMaxLoad() && (!$maxRepeat || $loop < $maxRepeat)) {
            shell_exec($command);
            usleep($this->getSleep());
            $loop++;
        }
        return $loop;
    }

    /**
     * @return float current cpu load in percentage
     * @todo must implement getting load percentage in windows too
     */
    public static function getLoadPercentage()
    {
        $loads = sys_getloadavg();
        if (!static::$CPUs) {
            static::$CPUs = trim(shell_exec("grep -P '^physical id' /proc/cpuinfo|wc -l"));
        }
        $load = ($loads[0] / static::$CPUs) * 100;
        return $load;
    }
}