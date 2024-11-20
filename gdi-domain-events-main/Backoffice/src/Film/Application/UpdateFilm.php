<?php

namespace Gdi\Backoffice\Film\Application;

use Gdi\Backoffice\Film\Domain\Exception\FilmNotFound;
use Gdi\Backoffice\Film\Domain\Repository\FilmReadRepository;
use Gdi\Backoffice\Film\Domain\Repository\FilmWriteRepository;
use Gdi\Backoffice\Film\Domain\ValueObject\FilmId;
use Gdi\Backoffice\Film\Domain\ValueObject\FilmTitle;

final readonly class UpdateFilm
{
    public function __construct(
        private FilmReadRepository $filmReadRepository,
        private FilmWriteRepository $filmWriteRepository
    ) {
    }

    /**
     * @throws FilmNotFound
     */
    public function __invoke(FilmId $id, FilmTitle $newFilmTitle): void
    {
        $film = $this->filmReadRepository->ofIdOrFail($id);

        $film->updateTitle($newFilmTitle);

        $this->filmWriteRepository->update($film);
    }
}