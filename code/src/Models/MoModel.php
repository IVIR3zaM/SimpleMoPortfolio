<?php
namespace IVIR3zaM\SimpleMoPortfolio\Models;

use Phalcon\Mvc\Model;
use IVIR3zaM\SimpleMoPortfolio\MoTrait;

/**
 * Class MoModel
 * This Mo Model class and used to save Mo into database and interact with database
 * @package IVIR3zaM\SimpleMoPortfolio\Models
 * @todo must implement functional and integrational tests
 */
class MoModel extends Model implements MoModelInterface
{
    use MoTrait, MoModelTrait;

    /**
     * Set the name of Mo table in the database
     */
    public function initialize()
    {
        $this->setSource('mo');
    }
}