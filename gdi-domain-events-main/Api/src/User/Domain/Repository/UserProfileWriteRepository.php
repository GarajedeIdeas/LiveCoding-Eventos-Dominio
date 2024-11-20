<?php

namespace Gdi\Api\User\Domain\Repository;

use Gdi\Api\User\Domain\Entity\UserProfile;

interface UserProfileWriteRepository
{
    public function create(UserProfile $userProfile): void;
}