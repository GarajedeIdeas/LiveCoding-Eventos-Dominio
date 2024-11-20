<?php

namespace Gdi\Api\Film\Domain\ValueObject;

use Gdi\Shared\Domain\Exception\EmptyString;
use Gdi\Shared\Domain\ValueObject\CacheKey;
use Gdi\Shared\Domain\ValueObject\NonEmptyString;

final class FilmCacheKey extends NonEmptyString implements CacheKey
{
    private const string REDIS_KEY_TEMPLATE = 'film.%s';

    /**
     * @throws EmptyString
     */
    public static function ofFilmId(FilmId $filmId): self
    {
        $key = sprintf(self::REDIS_KEY_TEMPLATE, $filmId->value());

        return self::create($key);
    }
}