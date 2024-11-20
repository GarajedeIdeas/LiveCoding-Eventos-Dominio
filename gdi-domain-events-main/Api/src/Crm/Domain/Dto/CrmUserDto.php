<?php

namespace Gdi\Api\Crm\Domain\Dto;

use Gdi\Api\User\Domain\ValueObject\UserEmail;
use Gdi\Api\User\Domain\ValueObject\UserId;

final readonly class CrmUserDto
{
    public function __construct(
        public UserId $userId,
        public UserEmail $userEmail
    ) {
    }
}