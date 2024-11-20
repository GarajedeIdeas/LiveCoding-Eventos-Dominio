<?php

namespace Gdi\Api\User\Application;

use Gdi\Api\User\Domain\Entity\UserProfile;
use Gdi\Api\User\Domain\Repository\UserProfileWriteRepository;
use Gdi\Api\User\Domain\ValueObject\UserId;
use Gdi\Api\User\Domain\ValueObject\UserProfileId;
use Gdi\Shared\Domain\Exception\EmptyString;
use Gdi\Shared\Domain\ValueObject\Uuid;

final readonly class CreateUserDefaultMainProfile
{
    public function __construct(
        private UserProfileWriteRepository $userProfileWriteRepository
    ) {
    }

    /**
     * @throws EmptyString
     */
    public function __invoke(UserId $userId): void
    {
        $userProfile = UserProfile::createDefaultMain(
            UserProfileId::create(Uuid::random()->value()),
            $userId
        );

        $this->userProfileWriteRepository->create($userProfile);
    }
}