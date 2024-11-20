<?php

declare(strict_types=1);

namespace Gdi\Api\User\Domain\ValueObject;

use Gdi\Shared\Domain\Exception\EmptyString;
use Gdi\Shared\Domain\ValueObject\NonEmptyString;

final class UserProfileName extends NonEmptyString
{
    private const string DEFAULT_MAIN = 'Profile';

    /**
     * @throws EmptyString
     */
    public static function defaultMain(): self
    {
        return self::create(self::DEFAULT_MAIN);
    }
}
