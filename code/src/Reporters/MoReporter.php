<?php
namespace IVIR3zaM\SimpleMoPortfolio\Reporters;

use Phalcon\Mvc\Model\ManagerInterface;
use Phalcon\Mvc\ModelInterface;
use DateTime;

/**
 * Class MoReporter
 * @package IVIR3zaM\SimpleMoPortfolio\Reporters
 * @todo must implement reporter for other kinds of databases
 * @todo must implement functional tests
 */
class MoReporter implements MoReporterInterface
{
    /**
     * @var ModelInterface
     */
    protected $model;

    /**
     * @var ManagerInterface
     */
    protected $manager;

    /**
     * @param ModelInterface $model
     * @param ManagerInterface|null $manager
     */
    public function __construct(ModelInterface $model, ManagerInterface $manager = null)
    {
        $this->setModel($model);
        if ($manager) {
            $this->setManager($manager);
        }
    }

    /**
     * @param ModelInterface $model
     * @return $this
     */
    public function setModel(ModelInterface $model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return ModelInterface
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param ManagerInterface $manager
     * @return mixed
     */
    public function setManager(ManagerInterface $manager)
    {
        $this->manager = $manager;
        return $this;
    }

    /**
     * @return ManagerInterface
     */
    public function getManager()
    {
        if (!$this->manager && $this->getModel()) {
            $this->setManager($this->getModel()->getModelsManager());
        }
        return $this->manager;
    }

    /**
     * @param DateTime $date
     * @return int The number of Mo in last x minutes
     */
    public function getLastMoCount(DateTime $date)
    {
        $class = get_class($this->getModel());
        $time = $date->format('Y-m-d H:i:s');
        $qry = "SELECT COUNT(*) AS cnt FROM {$class} WHERE created_at > :time:";
        $result = $this->getManager()->executeQuery($qry, ['time' => $time]);
        if (!$result->count()) {
            return false;
        }
        return intval($result->getFirst()->cnt);
    }

    /**
     * @param int $limit
     * @return array The time span of Mo in last x records
     */
    public function getTimeSpan($limit = 10000)
    {
        $connection = $this->getManager()->getReadConnection($this->getModel());
        $table = $this->getModel()->getSource();
        $limit = abs(intval($limit));

        $return = ['0000/00/00 00:00:00', '0000/00/00 00:00:00'];

        $qry = "SELECT MIN(created_at), MAX(created_at) FROM (
                    SELECT created_at FROM `{$table}` ORDER BY id DESC LIMIT {$limit}
                )t";
        $result = $connection->query($qry);

        $row = $result->fetchArray();
        if (!empty($row)) {
            $return[0] = $row[0];
            $return[1] = $row[1];
        }
        return $return;
    }
}