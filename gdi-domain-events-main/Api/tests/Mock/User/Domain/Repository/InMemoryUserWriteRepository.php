<?php

namespace Gdi\Api\Tests\Mock\User\Domain\Repository;

use Gdi\Api\User\Domain\Entity\User;
use Gdi\Api\User\Domain\Repository\UserWriteRepository;

final class InMemoryUserWriteRepository implements UserWriteRepository
{
    /** @var list<int, User> */
    public array $users;

    public function create(User $user): void
    {
        $this->users[$user->id()->value()] = $user;
    }
}