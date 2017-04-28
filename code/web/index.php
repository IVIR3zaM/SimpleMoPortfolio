<?php
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Micro;

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

    $app->get(
        '/',
        function () {
            return '{"status": "ok"}'."\n";
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