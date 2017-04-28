<?php
namespace IVIR3zaM\SimpleMoPortfolio\Reporters;

use Phalcon\Mvc\Model\ManagerInterface;
use Phalcon\Mvc\ModelInterface;
use DateTime;

/**
 * Interface MoReporterInterface
 * Interface for any reporter that accepts a Model class and a Model Manager object and returns
 * the number of Mo in last x minutes and the time span of Mo in last x records
 * @package IVIR3zaM\SimpleMoPortfolio\Reporters
 */
interface MoReporterInterface
{
    /**
     * @param ModelInterface $model
     * @param ManagerInterface|null $manager
     */
    public function __construct(ModelInterface $model, ManagerInterface $manager = null);

    /**
     * @param ModelInterface $model
     * @return $this
     */
    public function setModel(ModelInterface $model);

    /**
     * @return ModelInterface
     */
    public function getModel();

    /**
     * @param ManagerInterface $manager
     * @return mixed
     */
    public function setManager(ManagerInterface $manager);

    /**
     * @return ManagerInterface
     */
    public function getManager();

    /**
     * @param DateTime $date
     * @return int The number of Mo in last x minutes
     */
    public function getLastMoCount(DateTime $date);

    /**
     * @param int $limit
     * @return array The time span of Mo in last x records
     */
    public function getTimeSpan($limit = 10000);
}