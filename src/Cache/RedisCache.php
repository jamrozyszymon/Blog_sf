<?php

namespace App\Cache;

use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Symfony\Component\Cache\Adapter\RedisAdapter;

class RedisCache implements CacheInterface
{
    public $cache;

    public function __construct()
    {
        $this->cache = new TagAwareAdapter(
            new RedisAdapter( RedisAdapter::createConnection('redis://localhost'))
        );
    }
}
