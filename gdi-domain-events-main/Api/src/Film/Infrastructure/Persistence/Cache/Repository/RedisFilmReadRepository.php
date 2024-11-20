<?php

declare(strict_types=1);

namespace Gdi\Api\Film\Infrastructure\Persistence\Cache\Repository;

use Gdi\Api\Film\Domain\Entity\Film;
use Gdi\Api\Film\Domain\Exception\FilmNotFound;
use Gdi\Api\Film\Domain\Repository\FilmReadRepository;
use Gdi\Api\Film\Domain\ValueObject\FilmCacheKey;
use Gdi\Api\Film\Domain\ValueObject\FilmId;
use Gdi\Shared\Domain\Exception\EmptyString;
use Gdi\Shared\Infrastructure\Persistence\Cache\Repository\CacheReadRepository;
use Gdi\Shared\Infrastructure\Persistence\Cache\Repository\CacheWriteRepository;

final readonly class RedisFilmReadRepository implements FilmReadRepository
{
    private const int ONE_HOUR_IN_SECONDS = 3600;

    public function __construct(
        private FilmReadRepository $doctrineFilmReadRepository,
        private CacheReadRepository $cacheReadRepository,
        private CacheWriteRepository $cacheWriteRepository,
    ) {
    }

    /**
     * @throws FilmNotFound
     * @throws EmptyString
     */
    public function ofIdOrFail(FilmId $id): Film
    {
        $redisKey = FilmCacheKey::ofFilmId($id);

        $film = $this->cacheReadRepository->get($redisKey);

        if ($film === null) {
            $film = $this->doctrineFilmReadRepository->ofIdOrFail($id);

            $this->cacheWriteRepository->set($redisKey, $film, self::ONE_HOUR_IN_SECONDS);
        }

        return $film;
    }
}
