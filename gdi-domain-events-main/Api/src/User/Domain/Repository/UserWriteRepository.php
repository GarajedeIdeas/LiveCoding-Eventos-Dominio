<?php

namespace Gdi\Api\User\Domain\Repository;

use Gdi\Api\User\Domain\Entity\User;

interface UserWriteRepository
{
    public function create(User $user): void;
}