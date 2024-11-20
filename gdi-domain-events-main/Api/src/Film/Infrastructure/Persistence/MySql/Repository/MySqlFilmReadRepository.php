<?php

declare(strict_types=1);

namespace Gdi\Api\Film\Infrastructure\Persistence\MySql\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Gdi\Api\Film\Domain\Entity\Film;
use Gdi\Api\Film\Domain\Exception\FilmNotFound;
use Gdi\Api\Film\Domain\Repository\FilmReadRepository;
use Gdi\Api\Film\Domain\ValueObject\FilmId;
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
