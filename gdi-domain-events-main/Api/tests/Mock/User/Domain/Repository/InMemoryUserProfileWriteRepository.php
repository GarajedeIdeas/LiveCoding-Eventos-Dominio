<?php

namespace Gdi\Api\Tests\Mock\User\Domain\Repository;

use Gdi\Api\User\Domain\Entity\UserProfile;
use Gdi\Api\User\Domain\Repository\UserProfileWriteRepository;

final class InMemoryUserProfileWriteRepository implements UserProfileWriteRepository
{
    /** @var list<int, UserProfile> */
    public array $userProfiles;

    public function create(UserProfile $userProfile): void
    {
        $this->userProfiles[$userProfile->userId()->value()] = $userProfile;
    }
}