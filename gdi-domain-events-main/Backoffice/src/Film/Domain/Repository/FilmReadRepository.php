<?php

namespace Gdi\Backoffice\Film\Domain\Repository;

use Gdi\Backoffice\Film\Domain\Entity\Film;
use Gdi\Backoffice\Film\Domain\Exception\FilmNotFound;
use Gdi\Backoffice\Film\Domain\ValueObject\FilmId;

interface FilmReadRepository
{
    /**
     * @throws FilmNotFound
     */
    public function ofIdOrFail(FilmId $id): Film;
}