<?php

declare(strict_types=1);

namespace Gdi\Shared\Domain\Exception;

use Exception;

final class InvalidUuidException extends Exception
{
    public static function withValue(string $value): self
    {
        return new self('Invalid uuid format: ' . $value);
    }
}
