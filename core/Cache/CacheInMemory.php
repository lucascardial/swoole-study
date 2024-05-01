<?php

namespace Core\Cache;

class CacheInMemory implements CacheInterface
{
    private array $cache = [];

    public function get(string $key): mixed
    {
        return $this->cache[$key] ?? null;
    }

    public function set(string $key, mixed $value, int $ttl = 0): void
    {
        $this->cache[$key] = $value;
    }

    public function delete(string $key): void
    {
        unset($this->cache[$key]);
    }

    public function all(): array
    {
        return $this->cache;
    }
}