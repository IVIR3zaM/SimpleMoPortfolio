<?php
namespace IVIR3zaM\SimpleMoPortfolio\Tests\Controllers;

/**
 * Class AbstractJsonOutputControllerTest
 * @package IVIR3zaM\SimpleMoPortfolio\Tests\Controllers
 */
class AbstractJsonOutputControllerTest extends AbstractControllersTestCase
{
    /**
     * Testing the output of AbstractJsonOutputController class
     */
    public function testOutput()
    {
        $input = ['Foo' => 'Bar'];

        $dispatcher = $this->getDI()->get('dispatcher');
        $default = $dispatcher->getDefaultNamespace();
        $dispatcher->setDefaultNamespace('IVIR3zaM\SimpleMoPortfolio\Tests\Controllers');

        $response = $this->callController('json_output', 'test', [$input]);
        $this->assertJson(json_encode($input), $response);

        $dispatcher->setDefaultNamespace($default);
    }
}