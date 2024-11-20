<?php

namespace Gdi\Api\Crm\Application;

use Gdi\Api\Crm\Domain\Dto\CrmUserDto;
use Gdi\Api\Crm\Domain\Repository\CrmWriteRepository;
use Gdi\Api\User\Domain\ValueObject\UserEmail;
use Gdi\Api\User\Domain\ValueObject\UserId;

final readonly class CreateCrmUser
{
    public function __construct(private CrmWriteRepository $crmWriteRepository)
    {
    }

    public function __invoke(UserId $userId, UserEmail $userEmail): void
    {
        $crmUserDto = new CrmUserDto(
            $userId,
            $userEmail
        );

        $this->crmWriteRepository->createUser($crmUserDto);
    }
}