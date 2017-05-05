<?php
namespace IVIR3zaM\SimpleMoPortfolio;

use IVIR3zaM\SimpleMoPortfolio\Models\MoModel;
use IVIR3zaM\SimpleMoPortfolio\Models\MoModelInterface;
use DateTime;

/**
 * Class MoFactory
 * The factory of Mo Models for persistent them into database or mocking in unit testing
 * @package IVIR3zaM\SimpleMoPortfolio
 */
class MoFactory implements MoFactoryInterface
{
    /**
     * Making a model from a Mo object
     * @param MoInterface $mo
     * @param string $token
     * @return MoModelInterface
     */
    public function makeModel(MoInterface $mo, $token)
    {
        $model = new MoModel();
        $model->setFromArray($mo->getArray());
        $model->setAuthToken($token);
        $model->setCreatedAt(new DateTime());
        $model->save();
        return $model;
    }
}