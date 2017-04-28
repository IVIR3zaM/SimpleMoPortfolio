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

$di->setShared('threadsManager', function () use ($di) {
    $config = $di->get('config');
    $class = $config->threads->class;
    $manager = new $class();
    $manager->setMaxLoad($config->threads->maxLoad);
    return $manager;
});

$di->setShared('reporter', function() use ($di) {
    $config = $di->get('config');
    $class = $config->reporter->class;
    $model = $config->reporter->model;
    $reporter = new $class(new $model());
    return $reporter;
});

return $di;