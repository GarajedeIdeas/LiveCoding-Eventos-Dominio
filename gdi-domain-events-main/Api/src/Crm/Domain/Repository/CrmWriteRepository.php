<?php

namespace Gdi\Api\Crm\Domain\Repository;

use Gdi\Api\Crm\Domain\Dto\CrmUserDto;

interface CrmWriteRepository
{
    public function createUser(CrmUserDto $crmUserDto): void;
}