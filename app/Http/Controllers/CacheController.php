<?php

namespace TheMembers\Shortner\Http\Controllers;

use Core\Cache\CacheInterface;

readonly class CacheController
{
    public function __construct(
        private CacheInterface $cache
    )
    {
    }

    public function __invoke()
    {
        return json_encode($this->cache->all());
    }
}