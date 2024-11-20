<?php

namespace Gdi\Api\Film\Domain\Repository;

use Gdi\api\Film\Domain\Entity\Film;
use Gdi\api\Film\Domain\Exception\FilmNotFound;
use Gdi\api\Film\Domain\ValueObject\FilmId;

interface FilmReadRepository
{
    /**
     * @throws FilmNotFound
     */
    public function ofIdOrFail(FilmId $id): Film;
}