<?php

namespace Gdi\Api\Email\Application;

use Gdi\Api\Email\Domain\Service\EmailService;
use Gdi\Api\Email\Domain\Template\ConfirmationEmail;
use Gdi\Api\User\Domain\ValueObject\UserEmail;

final readonly class SendConfirmationEmail
{
    public function __construct(private EmailService $emailService)
    {
    }

    public function __invoke(UserEmail $userEmail): void
    {
        $confirmationEmail = new ConfirmationEmail();

        $this->emailService->send($confirmationEmail, $userEmail);
    }
}