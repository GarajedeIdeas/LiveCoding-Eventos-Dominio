<?php

declare(strict_types=1);

namespace Gdi\Shared\Domain\Exception;

use Exception;

final class EmptyString extends Exception
{
    private const string EXCEPTION_MESSAGE = 'Empty string provided to';

    public static function throw(string $className): self
    {
        return new self(
            sprintf(
                '%s %s',
                self::EXCEPTION_MESSAGE,
                $className
            )
        );
    }
}
