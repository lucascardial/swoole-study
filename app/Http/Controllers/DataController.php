<?php
namespace TheMembers\Shortner\Http\Controllers;

use Core\Cache\CacheInterface;
use Core\Request\Request;

class DataController
{
    public function __construct(
        private readonly CacheInterface $cache,
    )
    {
    }

    public function __invoke(Request $request): string
    {
        $randomKey = bin2hex(random_bytes(16));

        $this->cache->set($randomKey, $request->all());

        return json_encode([
            'data' => $this->cache->all()
       ]);
    }
}