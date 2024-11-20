<?php

namespace Gdi\Backoffice\Film\Domain\Repository;

use Gdi\Backoffice\Film\Domain\Entity\Film;

interface FilmWriteRepository
{
    public function update(Film $film): void;
}