<?php
namespace IVIR3zaM\SimpleMoPortfolio\Queue;

use IVIR3zaM\SimpleMoPortfolio\MoInterface;

/**
 * Interface QueueInterface
 * The basic of an Mo Queue object. this is an FIFO (First In, First Out) queue
 * @package IVIR3zaM\SimpleMoPortfolio\Queue
 */
interface QueueInterface
{
    /**
     * Push an Mo object into the queue
     * @param MoInterface $mo
     * @return $this
     */
    public function push(MoInterface $mo);

    /**
     * Get the first item in the queue and remove it from the queue
     * @return MoInterface
     */
    public function pop();

    /**
     * Count the number of MOs in the queue
     * @return number
     */
    public function count();

    /**
     * Clear all MOs in the queue
     * @return boolean was the process successful or not
     */
    public function clear();
}