<?php

namespace Gdi\Shared\Infrastructure\Persistence\Cache\Repository;

use Gdi\Shared\Domain\ValueObject\CacheKey;

interface CacheReadRepository
{
    public function get(CacheKey $key): mixed;
}