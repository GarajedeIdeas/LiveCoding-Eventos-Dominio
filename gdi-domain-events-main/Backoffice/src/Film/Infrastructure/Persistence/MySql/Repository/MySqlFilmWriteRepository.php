<?php

declare(strict_types=1);

namespace Gdi\Backoffice\Film\Infrastructure\Persistence\MySql\Repository;

use Gdi\Backoffice\Film\Domain\Entity\Film;
use Gdi\Backoffice\Film\Domain\Repository\FilmWriteRepository;
use Gdi\Shared\Infrastructure\Persistence\Doctrine\DoctrinePostgresRegistry;

final readonly class MySqlFilmWriteRepository implements FilmWriteRepository
{
    public function __construct(
        private DoctrinePostgresRegistry $registry,
    ) {
    }

    public function update(Film $film): void
    {
        $this->registry->persist($film);
    }
}
