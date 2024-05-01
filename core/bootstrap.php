<?php

use Core\Cache\CacheInMemory;
use Core\Cache\CacheInterface;
use Core\Container\Container;
use Core\Request\RequestHandler;

require __DIR__ . '/../app/routes.php';

$container = Container::instance();

$container->singleton(CacheInterface::class, CacheInMemory::class);
$container->bind(RequestHandler::class);

$app = new Swoole\Http\Server("0.0.0.0", 8099);

$app->on('start', function ($server) {
    echo "Swoole http server is started";
});


$app->on('request', new RequestHandler(Container::instance()));

$app->start();