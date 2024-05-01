<?php

namespace Core\Facades;

use Core\Routing\Router as RouterAlias;

/**
 * @method static  \Core\Routing\Route  get(string $uri, string $action)
 * @method static  \Core\Routing\Route  post(string $uri, string $action)
 * @method static  \Core\Routing\Route[] getRoutes()
 */
class Route
{
    protected static RouterAlias | null $routerInstance = null;

    public static function __callStatic($name, $arguments)
    {
        if (!self::$routerInstance) {
            self::$routerInstance = new RouterAlias();
        }

        return self::$routerInstance->$name(...$arguments);
    }
}