<?php

namespace Gdi\Api\Tests\Unit\Email\Application;

use Gdi\Api\Email\Application\SendConfirmationEmail;
use Gdi\Api\Email\Domain\Template\ConfirmationEmail;
use Gdi\Api\Tests\Mock\Email\Domain\Service\InMemoryEmailService;
use Gdi\Api\User\Domain\ValueObject\UserEmail;
use PHPUnit\Framework\TestCase;

final class SendConfirmationEmailTest extends TestCase
{
    private const string USER_EMAIL = 'manel@email.test';

    private InMemoryEmailService $emailService;
    private SendConfirmationEmail $sendConfirmationEmail;

    protected function setUp(): void
    {
        parent::setUp();

        $this->emailService = new InMemoryEmailService();
        $this->sendConfirmationEmail = new SendConfirmationEmail(
            $this->emailService
        );
    }

    public function testThatConfirmationEmailIsSent(): void
    {
        $userEmail = UserEmail::create(self::USER_EMAIL);

        $this->sendConfirmationEmail->__invoke($userEmail);

        $sentEmailTemplate = $this->emailService->sentEmails[$userEmail->value()][0];

        self::assertInstanceOf(ConfirmationEmail::class, $sentEmailTemplate);
    }
}