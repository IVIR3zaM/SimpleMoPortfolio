<?php
namespace IVIR3zaM\SimpleMoPortfolio\Tests\Controllers;

use Phalcon\Http\Request;

/**
 * Class MoControllerTest
 * @package IVIR3zaM\SimpleMoPortfolio\Tests\Controllers
 */
class MoControllerTest extends AbstractControllersTestCase
{
    public function testReceiveAction()
    {
        $mo = [
            'msisdn' => 1,
            'operatorid' => 2,
            'shortcodeid' => 3,
            'text' => 'Some Text',
        ];

        $request = $this->getMock(Request::class);
        $request->expects($this->any())
            ->method('get')
            ->will($this->returnValue($mo));

        $queue = new Queue();

        $this->getDI()->setShared('request', function () use ($request) {
            return $request;
        });
        $this->getDI()->setShared('queue', function () use ($queue) {
            return $queue;
        });

        $response = $this->callController('mo', 'receive');
        $this->assertJson(json_encode(['status' => 'Ok']), $response);

        $this->assertSame($mo, $queue->pop()->getArray());
    }
}