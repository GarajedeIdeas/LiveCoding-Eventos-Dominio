<?php

declare(strict_types=1);

namespace Gdi\Shared\Domain\Exception;

use Exception;

final class InvalidEmailFormat extends Exception
{
    public static function withValue(string $value): self
    {
        return new self('Invalid email format: ' . $value);
    }
}
