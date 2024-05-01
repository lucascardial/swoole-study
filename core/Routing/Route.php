<?php

namespace Core\Routing;

final readonly class Route
{
    public function __construct(
        public string $method,
        public string $uri,
        public string $action,
    )
    {
    }
}