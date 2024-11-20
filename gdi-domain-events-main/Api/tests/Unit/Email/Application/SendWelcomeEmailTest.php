<?php

namespace Gdi\Api\Tests\Unit\Email\Application;

use Gdi\Api\Email\Application\SendWelcomeEmail;
use Gdi\Api\Email\Domain\Template\WelcomeEmail;
use Gdi\Api\Tests\Mock\Email\Domain\Service\InMemoryEmailService;
use Gdi\Api\User\Domain\ValueObject\UserEmail;
use PHPUnit\Framework\TestCase;

final class SendWelcomeEmailTest extends TestCase
{
    private const string USER_EMAIL = 'manel@email.test';

    private InMemoryEmailService $emailService;
    private SendWelcomeEmail $sendWelcomeEmail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->emailService = new InMemoryEmailService();
        $this->sendWelcomeEmail = new SendWelcomeEmail(
            $this->emailService
        );
    }

    public function testThatWelcomeEmailIsSent(): void
    {
        $userEmail = UserEmail::create(self::USER_EMAIL);

        $this->sendWelcomeEmail->__invoke($userEmail);

        $sentEmailTemplate = $this->emailService->sentEmails[$userEmail->value()][0];

        self::assertInstanceOf(WelcomeEmail::class, $sentEmailTemplate);
    }
}