<?php
namespace IVIR3zaM\SimpleMoPortfolio\Controllers;

use IVIR3zaM\SimpleMoPortfolio\Mo;
use Phalcon\Http\ResponseInterface;

/**
 * Class MoController
 * @package IVIR3zaM\SimpleMoPortfolio\Controllers
 */
class MoController extends AbstractJsonOutputController
{
    /**
     * Receive an Mo from request params and push that into th queue
     * @return ResponseInterface
     */
    public function receiveAction()
    {
        $request = $this->getDI()->get('request');
        $queue = $this->getDI()->get('queue');

        $queue->push(new Mo($request->get()));

        $this->getOutput()->status = 'Ok';
        return $this->initResponse();
    }
}