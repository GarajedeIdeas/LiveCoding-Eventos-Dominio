<?php

declare(strict_types=1);

namespace Gdi\Shared\Domain\Exception;

use Exception;

final class InvalidLength extends Exception
{
    private const string EXCEEDS_MESSAGE = 'Param %s length limit is %s and %s given';
    private const string OUT_OF_RANGE_MESSAGE = '%s length must be between %s and %s characters';

    public static function exceedsWithParamValueAndLimit(string $param, int $value, int $limit): self
    {
        return new self(
            sprintf(
                self::EXCEEDS_MESSAGE,
                $param,
                $limit,
                $value
            )
        );
    }

    public static function lengthOutOfRange(string $paramName, int $lowLimit, int $upLimit): self
    {
        return new self(
            sprintf(
                self::OUT_OF_RANGE_MESSAGE,
                $paramName,
                $lowLimit,
                $upLimit
            )
        );
    }
}
