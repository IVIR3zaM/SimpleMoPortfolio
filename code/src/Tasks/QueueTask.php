<?php
namespace IVIR3zaM\SimpleMoPortfolio\Tasks;

use Phalcon\Cli\Task;
use IVIR3zaM\SimpleMoPortfolio\MoInterface;
use IVIR3zaM\SimpleMoPortfolio\Queue\QueueInterface;
use IVIR3zaM\SimpleMoPortfolio\Threads\ManagerInterface;
use IVIR3zaM\SimpleMoPortfolio\MoFactoryInterface;

/**
 * Class QueueTask
 * @package IVIR3zaM\SimpleMoPortfolio\Tasks
 * @todo must implement functional tests
 */
class QueueTask extends Task
{
    /**
     * @var int The number of concurrent items
     */
    protected $concurrentItems;

    /**
     * @var string The base path of proect for calling commands
     */
    protected $basePath;

    /**
     * @return int
     */
    public function getConcurrentItems()
    {
        return $this->concurrentItems;
    }

    /**
     * @param int $items
     * @return $this
     */
    public function setConcurrentItems($items)
    {
        $this->concurrentItems = intval($items);
        return $this;
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setBasePath($path)
    {
        $this->basePath = (string) $path;
        return $this;
    }


    /**
     * @return QueueInterface
     */
    public function getQueue()
    {
        return $this->getDI()->get('queue');
    }

    /**
     * @return ManagerInterface
     */
    public function getManager()
    {
        return $this->getDI()->get('threadsManager');
    }

    /**
     * @return MoFactoryInterface
     */
    public function getFactory()
    {
        return $this->getDI()->get('factory');
    }

    protected function initializeParams($params)
    {
        $this->setConcurrentItems($params[0] ?? 10);
        $this->setBasePath($params[1] ?? dirname(dirname(__DIR__)));
    }

    public function handlerAction($params)
    {
        $this->initializeParams($params);

        $file = $this->getBasePath() . '/cache/queue.lock';
        $lock = $this->lockFile($file);
        if (!$lock) {
            echo 'Queue already running!' . PHP_EOL;
            return;
        }

        while ($this->getQueue()->count() > 0 && file_exists($file)) {
            $total = $this->getManager()->runCommand(PHP_BINARY . ' ' . $this->getBasePath() . '/cli.php queue run ' . $this->getConcurrentItems() . ' "' . $this->getBasePath() . '"', 10);
            // detect if stopped due to overload
            if ($total < 10) {
                sleep(1);
            }
        }

        $this->unlockFile($lock);
        echo 'Done!' . PHP_EOL;
    }

    public function runAction($params)
    {
        $this->initializeParams($params);
        while ($this->getQueue()->count() > 0 && $this->getConcurrentItems() > 0) {
            $mo = $this->getQueue()->pop();
            $token = $this->getAuthToken($mo);
            $this->getFactory()->makeModel($mo, $token);
            $this->setConcurrentItems($this->getConcurrentItems() - 1);
        }
        echo 'Done!' . PHP_EOL;
    }

    public function countAction()
    {
        echo $this->getQueue()->count() . PHP_EOL;
    }

    public function clearAction()
    {
        echo 'clearing queue was ' . ($this->getQueue()->clear() ? 'SUCCESSFUL' : 'FAILED') . PHP_EOL;
    }

    protected function getAuthToken(MoInterface $mo)
    {
        $json = json_encode($mo->getArray());
        return `{$this->getBasePath()}/web/registermo {$json}`;
    }

    protected function lockFile($file = '')
    {
        if (file_exists($file)) {
            $type = 'r+';
        } else {
            $type = 'w+';
        }
        $fp = fopen($file, $type);
        if ($fp) {
            if (flock($fp, LOCK_EX | LOCK_NB)) {
                return $fp;
            }
        }
        return false;
    }

    protected function unlockFile($fp)
    {
        if ($fp) {
            flock($fp, LOCK_UN);
            fclose($fp);
        }
    }
}