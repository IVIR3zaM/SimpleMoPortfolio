<?php

$di->setShared('config', function () {
    return require __DIR__ . '/config.php';
});

$di->setShared('modelsMetadata', function () use ($di) {
    $config = $di->get('config');
    $class = $config->metaData->class;
    $params = $config->metaData->params->toArray();
    return new $class($params);
});

$di->setShared('db', function () use ($di) {
    $config = $di->get('config');
    $class = '\Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    return new $class([
        'host' => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname' => $config->database->dbname,
        'charset' => $config->database->charset,
        'persistent' => true,
        'options' => $config->database->options->toArray(),
    ]);
});

$di->setShared('queue', function () use ($di) {
    $config = $di->get('config');
    $class = $config->queue->class;
    $params = $config->queue->params->toArray();
    return new $class($params);
});


return $di;