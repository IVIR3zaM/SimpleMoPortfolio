<?php
use Phalcon\Config;
use Phalcon\Mvc\Model\Metadata\Files as MetaDataAdapter;

return new Config([
    'database' => [
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname' => 'samtt',
        'charset' => 'utf8',
        'options' => [],
    ],
    'metaData' => [
        'class' => MetaDataAdapter::class,
        'params' => [
            'metaDataDir' => dirname(__DIR__) . '/cache/metaData/',
        ],
    ],
]);