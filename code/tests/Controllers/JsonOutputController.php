<?php
namespace IVIR3zaM\SimpleMoPortfolio\Tests\Controllers;

use IVIR3zaM\SimpleMoPortfolio\Controllers\AbstractJsonOutputController;

/**
 * Class JsonOutputController
 * A holder for testing AbstractJsonOutputController class
 * @package IVIR3zaM\SimpleMoPortfolio\Tests\Controllers
 */
class JsonOutputController extends AbstractJsonOutputController
{
    /**
     * @param array $output
     */
    public function testAction($output)
    {
        $this->getOutput()->setFromInput($output);
    }
}