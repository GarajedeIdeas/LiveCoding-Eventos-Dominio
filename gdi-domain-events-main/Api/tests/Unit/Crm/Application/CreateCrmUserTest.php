<?php

namespace Gdi\Api\Tests\Unit\Crm\Application;

use Gdi\Api\Crm\Application\CreateCrmUser;
use Gdi\Api\Crm\Domain\Dto\CrmUserDto;
use Gdi\Api\Tests\Mock\Crm\Domain\Repository\InMemoryCrmWriteRepository;
use Gdi\Api\User\Domain\ValueObject\UserEmail;
use Gdi\Api\User\Domain\ValueObject\UserId;
use Gdi\Shared\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

final class CreateCrmUserTest extends TestCase
{
    private const string USER_EMAIL = 'manel@email.test';

    private InMemoryCrmWriteRepository $crmWriteRepository;
    private CreateCrmUser $createCrmUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->crmWriteRepository = new InMemoryCrmWriteRepository();
        $this->createCrmUser = new CreateCrmUser($this->crmWriteRepository);
    }

    public function testThatCrmUserIsCreated(): void
    {
        $userId = UserId::create(Uuid::random()->value());
        $userEmail = UserEmail::create(self::USER_EMAIL);

        $this->createCrmUser->__invoke($userId, $userEmail);

        $expectedCreatedCrmUser = new CrmUserDto($userId, $userEmail);

        self::assertCount(1, $this->crmWriteRepository->crmUsers);
        self::assertEquals(
            $expectedCreatedCrmUser,
            $this->crmWriteRepository->crmUsers[$userId->value()]
        );
    }
}