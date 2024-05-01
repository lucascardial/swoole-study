<?php

namespace Core\Request;

use Core\Cache\CacheInMemory;
use Core\Cache\CacheInterface;
use Core\Container\Container;
use Core\Container\ContainerInterface;
use Core\Facades\Route;

readonly class RequestHandler
{
    public function __construct(
        private ContainerInterface $container
    )
    {
    }

    public function __invoke(\Swoole\Http\Request $request, \Swoole\Http\Response $response): void
    {
        try {

            $response->header("Content-Type", "text/plain");
            $routes = Route::getRoutes();

            foreach ($routes as $route) {
                if ($route->method === $request->server['request_method'] && $route->uri === $request->server['request_uri']) {
                    $response->end($this->container->resolve($route->action)(Request::fromSwooleRequest($request)));
                }
            }

            $response->status(404);
            $response->end("Route not found\n");

        } catch (\Throwable $e) {
            $response->status(500);
            $response->end($e);
        }
    }
}