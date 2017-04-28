<?php
namespace IVIR3zaM\SimpleMoPortfolio\Tests\Controllers;

use Phalcon\Test\UnitTestCase as PhalconTestCase;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Http\Response;

/**
 * Class AbstractControllersTestCase
 * @package IVIR3zaM\SimpleMoPortfolio\Tests\Controllers
 */
abstract class AbstractControllersTestCase extends PhalconTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->getDI()->reset();

        $this->getDI()->setShared('response', function () {
            return new Response();
        });

        $this->getDI()->setShared('dispatcher', function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('IVIR3zaM\SimpleMoPortfolio\Controllers');
            return $dispatcher;
        });
    }

    /**
     * Calling a controller action based on given params and return the output
     *
     * @param string $controller controller name
     * @param string $action action name
     * @param array $params
     * @return string the output of the action
     */
    protected function callController($controller, $action, $params = [])
    {
        $dispatcher = $this->getDI()->get('dispatcher');
        $dispatcher->setControllerName($controller);
        $dispatcher->setActionName($action);
        $dispatcher->setParams($params);
        ob_start();
        $dispatcher->dispatch();
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}