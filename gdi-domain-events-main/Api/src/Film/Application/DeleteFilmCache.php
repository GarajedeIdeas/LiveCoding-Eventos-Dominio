<?php

namespace Gdi\Api\Film\Application;

use Gdi\Api\Film\Domain\Entity\Film;
use Gdi\Api\Film\Domain\ValueObject\FilmCacheKey;
use Gdi\Api\Film\Domain\ValueObject\FilmId;
use Gdi\Shared\Domain\Exception\EmptyString;
use Gdi\Shared\Infrastructure\Persistence\Cache\Repository\CacheWriteRepository;

final readonly class DeleteFilmCache
{
    public function __construct(private CacheWriteRepository $cacheWriteRepository)
    {
    }

    /**
     * @throws EmptyString
     */
    public function __invoke(FilmId $filmId): Film
    {
        $cacheKey = FilmCacheKey::ofFilmId($filmId);

        $this->cacheWriteRepository->delete($cacheKey);
    }
}