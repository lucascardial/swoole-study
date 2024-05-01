<?php

namespace Core\Container;

use Exception;
use ReflectionException;

class Container implements ContainerInterface
{
    private array $bindings = [];
    private array $instances = [];
    static $instance = null;

    public static function instance(): static
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function get(string $abstract): mixed
    {
        if(!$this->has($abstract))
            throw new Exception("{$abstract} not found in container");

        return $this->bindings[$abstract];
    }

    public function has(string $abstract): bool
    {
        return array_key_exists($abstract, $this->bindings);
    }

    /**
     * @throws ReflectionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function resolve(string $namespace, array $args = []): object
    {
         $instance = $this->resolveSingleton($namespace, $args);

//        if($this->isSingleton($namespace))
//            return $this->resolveSingleton($namespace, $args);
//
//
//        $instance = $this->resolver($namespace, $args);
//        var_dump($instance);
        return $instance;
    }

    /**
     * @throws ReflectionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function resolver(string $namespace, array $args = []): object
    {
        return (new ClassResolver($this, $namespace, $args))->getInstance();
    }

    public function bind(string $abstract, string $concrete = null, bool $shared = false): void
    {
        $this->bindings[$abstract] = compact('concrete', 'shared');
    }

    public function singleton(string $abstract, $concrete = null): void
    {
        $this->bind($abstract, $concrete, true);
    }

    private function isSingleton(string $abstract): bool
    {
        return $this->bindings[$abstract]['shared'] ?? false;
    }

    /**
     * @throws ReflectionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function resolveSingleton(string $abstract, array $args): object
    {
        if(!array_key_exists($abstract, $this->instances)) {
            $this->instances[$abstract] = $this->resolver($abstract, $args);
        }
        $instance = $this->instances[$abstract];

        var_dump($instance);

        return $instance;
    }
}