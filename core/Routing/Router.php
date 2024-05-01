<?php

namespace Core\Routing;

class Router
{
    public function __construct(
        private array $routes = []
    ){ }

    public function get(string $uri, string $action): void
    {
        $this->routes[] = new Route('GET', $uri, $action);
    }

    public function post(string $uri, string $action): void
    {
        $this->routes[] = new Route('POST', $uri, $action);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}