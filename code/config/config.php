<?php
use Phalcon\Config;
use Phalcon\Mvc\Model\Metadata\Files as MetaDataAdapter;
use IVIR3zaM\SimpleMoPortfolio\Queue\Redis;

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
    'queue' => [
        'class' => Redis::class,
        'params' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'list' => 'MoList',
        ],
    ],
]);