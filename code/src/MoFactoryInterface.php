<?php
namespace IVIR3zaM\SimpleMoPortfolio;

use IVIR3zaM\SimpleMoPortfolio\Models\MoModelInterface;

/**
 * Interface MoFactoryInterface
 * The factory of Mo Models for persistent them into database or mocking in unit testing
 * @package IVIR3zaM\SimpleMoPortfolio
 */
interface MoFactoryInterface
{
    /**
     * Making a model from a Mo object
     * @param MoInterface $mo
     * @param string $token
     * @return MoModelInterface
     */
    public function makeModel(MoInterface $mo, $token);
}