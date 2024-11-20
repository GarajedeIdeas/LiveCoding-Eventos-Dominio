<?php

declare(strict_types=1);

namespace Gdi\Backoffice\Film\Infrastructure\Persistence\MySql\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Gdi\Backoffice\Film\Domain\Entity\Film;
use Gdi\Backoffice\Film\Domain\Exception\FilmNotFound;
use Gdi\Backoffice\Film\Domain\Repository\FilmReadRepository;
use Gdi\Backoffice\Film\Domain\ValueObject\FilmId;
use Gdi\Shared\Infrastructure\Persistence\Doctrine\DoctrinePostgresRegistry;

final readonly class MySqlFilmReadRepository implements FilmReadRepository
{
    public function __construct(
        private DoctrinePostgresRegistry $registry,
    ) {
    }

    /**
     * @throws FilmNotFound
     */
    public function ofIdOrFail(FilmId $id): Film
    {
        $qb = $this->registry->createOrmQueryBuilder();

        $qb
            ->select('film')
            ->from(Film::class, 'film')
            ->andWhere('film.id = :id')
            ->setParameter('id', $id->value());

        try {
            return $qb
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException | NonUniqueResultException) {
            throw FilmNotFound::ofId($id);
        }
    }
}
