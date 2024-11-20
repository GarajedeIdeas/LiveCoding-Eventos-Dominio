<?php

namespace Gdi\Api\User\Application;

use Gdi\Api\User\Domain\Entity\User;
use Gdi\Api\User\Domain\Repository\UserWriteRepository;
use Gdi\Api\User\Domain\ValueObject\UserEmail;
use Gdi\Api\User\Domain\ValueObject\UserId;
use Gdi\Shared\Domain\ValueObject\Uuid;

final readonly class CreateUser
{
    public function __construct(
        private UserWriteRepository $userWriteRepository
    ) {
    }

    public function __invoke(UserEmail $email): void
    {
        $user = User::create(
            UserId::create(Uuid::random()->value()),
            $email
        );

        $this->userWriteRepository->create($user);
    }
}