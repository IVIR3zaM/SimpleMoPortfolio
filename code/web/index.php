<?php
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Micro;
use IVIR3zaM\SimpleMoPortfolio\Controllers\MoController;

try {
    require dirname(__DIR__) . '/vendor/autoload.php';
    $di = new FactoryDefault();
    require dirname(__DIR__) . '/config/services.php';

    /**
     * making new micro application and using Phalcon as a micro framework
     */
    $app = new Micro($di);


    /**
     * Routing part of our micro application
     */

    // Receive Mo action. it must to be an put action
    $app->get(
        '/',
        function () {
            return (new MoController())->receiveAction();
        }
    );

    $app->handle();
} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString(),
    ]);
}