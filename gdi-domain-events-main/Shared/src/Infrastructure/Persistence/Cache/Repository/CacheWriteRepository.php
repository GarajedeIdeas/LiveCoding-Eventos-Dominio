<?php

namespace Gdi\Shared\Infrastructure\Persistence\Cache\Repository;

use Gdi\Shared\Domain\ValueObject\CacheKey;

interface CacheWriteRepository
{
    public function set(CacheKey $key, mixed $element, int $ttlInSeconds): void;

    public function delete(CacheKey $key): void;
}