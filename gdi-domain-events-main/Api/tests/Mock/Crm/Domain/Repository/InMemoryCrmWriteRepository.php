<?php

namespace Gdi\Api\Tests\Mock\Crm\Domain\Repository;

use Gdi\Api\Crm\Domain\Dto\CrmUserDto;
use Gdi\Api\Crm\Domain\Repository\CrmWriteRepository;

final readonly class InMemoryCrmWriteRepository implements CrmWriteRepository
{
    /** @var list<int, CrmUserDto> */
    public array $crmUsers;

    public function createUser(CrmUserDto $crmUserDto): void
    {
        $this->crmUsers[$crmUserDto->userId->value()] = $crmUserDto;
    }
}