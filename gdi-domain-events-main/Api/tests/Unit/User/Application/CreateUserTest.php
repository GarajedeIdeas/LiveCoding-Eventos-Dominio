<?php

namespace Gdi\Api\Tests\Unit\User\Application;

use Gdi\Api\Tests\Mock\User\Domain\Repository\InMemoryUserWriteRepository;
use Gdi\Api\User\Application\CreateUser;
use Gdi\Api\User\Domain\ValueObject\UserEmail;
use PHPUnit\Framework\TestCase;

final class CreateUserTest extends TestCase
{
    private const string USER_EMAIL = 'manel@email.test';

    private InMemoryUserWriteRepository $userWriteRepository;
    private CreateUser $createUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userWriteRepository = new InMemoryUserWriteRepository();
        $this->createUser = new CreateUser(
            $this->userWriteRepository
        );
    }

    public function testThatUserIsCreated(): void
    {
        $userEmail = UserEmail::create(self::USER_EMAIL);

        $this->createUser->__invoke($userEmail);

        self::assertCount(1, $this->userWriteRepository->users);

        $createdUser = reset($this->userWriteRepository->users);

        self::assertEquals($userEmail, $createdUser->email());
    }
}