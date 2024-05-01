<?php


namespace Core\Container;

/**
 * Describes the interface of a container that exposes methods to read its entries.
 */
interface ContainerInterface
{
    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $abstract
     * @return mixed Entry.
     * @throws NotFoundExceptionInterface No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     */
    public function get(string $abstract): mixed;

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $abstract Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has(string $abstract): bool;

    public function resolve(string $namespace, array $args = []): object;

    public function bind(string $abstract, string $concrete = null, bool $shared = false): void;

    public function singleton(string $abstract, $concrete = null): void;
}