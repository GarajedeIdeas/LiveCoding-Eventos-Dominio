<?php

namespace Gdi\Api\Film\Application;

use Gdi\Api\Film\Domain\Entity\Film;
use Gdi\Api\Film\Domain\Exception\FilmNotFound;
use Gdi\Api\Film\Domain\Repository\FilmReadRepository;
use Gdi\Api\Film\Domain\ValueObject\FilmId;

final readonly class GetFilm
{
    public function __construct(private FilmReadRepository $filmReadRepository)
    {
    }

    /**
     * @throws FilmNotFound
     */
    public function __invoke(FilmId $filmId): Film
    {
        return $this->filmReadRepository->ofIdOrFail($filmId);
    }
}