<?php
namespace IVIR3zaM\SimpleMoPortfolio\Threads;

/**
 * Interface ManagerInterface
 * @package IVIR3zaM\SimpleMoPortfolio\Threads
 */
interface ManagerInterface
{
    /**
     * @param int $maxLoad The maximum load permitted percentage
     * @param int $sleep The micro seconds for wait after an async command runs
     */
    public function __construct($maxLoad = 100, $sleep = 1000);

    /**
     * Set the maximum load permitted for running a single command.
     * a number between 0 and 10,000 percentage
     * @param int $load
     * @return $this
     */
    public function setMaxLoad($load);

    /**
     * Get the maximum load permitted
     * @return int
     */
    public function getMaxLoad();

    /**
     * Set the micro seconds for wait after an async command runs
     * @param int $sleep
     * @return $this
     */
    public function setSleep($sleep);

    /**
     * Get the micro seconds for wait after an async command runs
     * @return int
     */
    public function getSleep();

    /**
     * Run a command to reach the maximum load permitted
     * @param string $command
     * @param int $maxRepeat The maximum number of times that the command repeated
     * @return int|false The number of times that command runs
     */
    public function runCommand($command, $maxRepeat = 0);
}