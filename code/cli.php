#!/usr/bin/php
<?php
use Phalcon\Di\FactoryDefault\Cli as CliDI;
use Phalcon\Cli\Console as ConsoleApp;

try {
    require __DIR__ . '/vendor/autoload.php';
    $di = new CliDI();
    require __DIR__ . '/config/services.php';

    /**
     * making new cli console
     */
    $app = new ConsoleApp($di);

    /**
     * Process the console arguments
     */
    $arguments = [];

    foreach ($argv as $k => $arg) {
        if ($k === 1) {
            $arguments['task'] = 'IVIR3zaM\\SimpleMoPortfolio\\Tasks\\' . ucfirst($arg);
        } elseif ($k === 2) {
            $arguments['action'] = $arg;
        } elseif ($k >= 3) {
            $arguments['params'][] = $arg;
        }
    }

    if (!isset($arguments['task'])) {
        $arguments['task'] = 'IVIR3zaM\\SimpleMoPortfolio\\Tasks\\Queue';
    }
    if (!isset($arguments['action'])) {
        $arguments['action'] = 'handler';
    }

    $app->handle($arguments);
} catch (Exception $e) {
    echo $e->getMessage();
    exit(255);
}