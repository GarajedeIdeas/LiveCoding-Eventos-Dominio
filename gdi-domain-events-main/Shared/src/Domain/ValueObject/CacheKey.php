<?php

namespace Gdi\Shared\Domain\ValueObject;

interface CacheKey
{
    public function value(): string;
}