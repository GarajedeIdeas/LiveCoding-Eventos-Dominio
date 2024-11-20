<?php

namespace Gdi\Api\Film\Infrastructure\Listener;

use Gdi\Api\Film\Application\DeleteFilmCache;
use Gdi\Api\Film\Domain\ValueObject\FilmId;
use Gdi\Api\Film\Infrastructure\Event\BackofficeFilmWasUpdated;
use Gdi\Shared\Domain\Exception\EmptyString;

final readonly class DeleteFilmCacheOnFilmWasUpdated
{
    public function __construct(private DeleteFilmCache $deleteFilmCache)
    {
    }

    /**
     * @throws EmptyString
     */
    public function __invoke(BackofficeFilmWasUpdated $event): void
    {
        $filmId = FilmId::create($event->filmId);

        $this->deleteFilmCache->__invoke($filmId);
    }
}