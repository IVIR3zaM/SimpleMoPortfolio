<?php
namespace IVIR3zaM\SimpleMoPortfolio\Tests\Controllers;

use IVIR3zaM\SimpleMoPortfolio\MoInterface;
use IVIR3zaM\SimpleMoPortfolio\Queue\QueueInterface;

/**
 * Class Queue
 * A double for testing Queue system
 * @package IVIR3zaM\SimpleMoPortfolio\Tests\Controllers
 */
class Queue implements QueueInterface
{
    private $list = [];

    /**
     * Push an Mo object into the queue
     * @param MoInterface $mo
     * @return $this
     */
    public function push(MoInterface $mo)
    {
        $this->list[] = $mo;
    }

    /**
     * Get the first item in the queue and remove it from the queue
     * @return MoInterface
     */
    public function pop()
    {
        reset($this->list);
        $key = key($this->list);
        $mo = $this->list[$key];
        unset($this->list[$key]);
        return $mo;
    }

    /**
     * Count the number of MOs in the queue
     * @return number
     */
    public function count()
    {
        return count($this->list);
    }

    /**
     * Clear all MOs in the queue
     * @return boolean was the process successful or not
     */
    public function clear()
    {
        $this->list = [];
    }
}