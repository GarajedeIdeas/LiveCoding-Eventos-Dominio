<?php

declare(strict_types=1);

namespace Gdi\Shared\Infrastructure\Persistence\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Result;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder as OrmQueryBuilder;
use RuntimeException;
use Symfony\Contracts\Service\ResetInterface;

use function get_class;

final readonly class DoctrinePostgresRegistry implements ResetInterface
{
    public function __construct(
        private Registry $registry
    ) {
    }

    /**
     * @param string $sql SQL query
     * @param list<mixed>|array<string, mixed> $params Query parameters
     * @param array<int, int|string|Type|null>|array<string, int|string|Type|null> $types Parameter types
     *
     * @throws Exception
     */
    public function executeQuery(string $sql, array $params = [], array $types = []): Result
    {
        return $this->connection()->executeQuery($sql, $params, $types);
    }

    public function createQueryBuilder(): QueryBuilder
    {
        return $this->connection()->createQueryBuilder();
    }

    public function connection(): Connection
    {
        $connection = $this->registry->getConnection();

        if (!$connection instanceof Connection) {
            throw new RuntimeException(
                'Expected a Connection in DoctrinePostgresRegistry but got a: ' . get_class($connection)
            );
        }

        return $connection;
    }

    public function createOrmQueryBuilder(): OrmQueryBuilder
    {
        return $this->manager()->createQueryBuilder();
    }

    public function persist(object $entity): void
    {
        $this->manager()->persist($entity);
    }

    public function flush(): void
    {
        $this->manager()->flush();
    }

    public function manager(): EntityManager
    {
        $entityManager = $this->registry->getManager();
        if (!$entityManager instanceof EntityManager) {
            throw new RuntimeException(
                'Expected an EntityManager in DoctrinePostgresRegistry but got a: ' . get_class($entityManager)
            );
        }

        return $entityManager;
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $entityClassName
     *
     * @return EntityRepository<T>
     */
    public function getRepository(string $entityClassName): EntityRepository
    {
        return $this->manager()->getRepository($entityClassName);
    }

    public function reset(): void
    {
        $this->registry->reset();
    }
}
