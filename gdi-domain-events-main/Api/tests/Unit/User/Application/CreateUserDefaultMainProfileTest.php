<?php

namespace Gdi\Api\Tests\Unit\User\Application;

use Gdi\Api\Tests\Mock\User\Domain\Repository\InMemoryUserProfileWriteRepository;
use Gdi\Api\User\Application\CreateUserDefaultMainProfile;
use Gdi\Api\User\Domain\ValueObject\UserId;
use Gdi\Api\User\Domain\ValueObject\UserProfileName;
use Gdi\Shared\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

final class CreateUserDefaultMainProfileTest extends TestCase
{
    private InMemoryUserProfileWriteRepository $userProfileWriteRepository;
    private CreateUserDefaultMainProfile $createUserDefaultMainProfile;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userProfileWriteRepository = new InMemoryUserProfileWriteRepository();
        $this->createUserDefaultMainProfile = new CreateUserDefaultMainProfile(
            $this->userProfileWriteRepository
        );
    }

    public function testThatDefaultMainUserProfileIsCreated(): void
    {
        $userId = UserId::create(Uuid::random()->value());

        $this->createUserDefaultMainProfile->__invoke($userId);

        $createdUserProfile = $this->userProfileWriteRepository->userProfiles[$userId->value()];

        self::assertEquals($userId, $createdUserProfile->userId());
        self::assertEquals(UserProfileName::defaultMain(), $createdUserProfile->name());
        self::assertTrue($createdUserProfile->isMain());
    }
}