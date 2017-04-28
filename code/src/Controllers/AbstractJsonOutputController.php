<?php
namespace IVIR3zaM\SimpleMoPortfolio\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;
use IVIR3zaM\SimpleMoPortfolio\Response\OutputInterface;
use IVIR3zaM\SimpleMoPortfolio\Response\Output;

/**
 * Class AbstractJsonOutputController
 * Abstract layer for controllers that outputs json data for example RESTFull APIs
 * @package IVIR3zaM\SimpleMoPortfolio\Controllers
 */
abstract class AbstractJsonOutputController extends Controller
{
    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @return OutputInterface
     */
    public function getOutput()
    {
        if (!$this->output) {
            $this->setOutput(new Output());
        }
        return $this->output;
    }

    /**
     * @param OutputInterface $output
     * @return $this
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
        return $this;
    }

    /**
     * @param ResponseInterface|null $response
     * @return ResponseInterface
     */
    public function initResponse(ResponseInterface $response = null)
    {
        if (!$response) {
            $response = new Response();
        }
        $response->setContentType('application/json');
        $response->setContent((string) $this->getOutput());
        return $response;
    }

    /**
     * Phalcon hook for running after each MVC controller action call
     * @return void
     */
    public function afterExecuteRoute()
    {
        $response = $this->initResponse($this->response);
        $response->send();
    }
}