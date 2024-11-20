<?php

namespace Gdi\Api\Tests\Mock\Email\Domain\Service;

use Gdi\Api\Email\Domain\Service\EmailService;
use Gdi\Api\Email\Domain\Template\EmailTemplate;
use Gdi\Api\User\Domain\ValueObject\UserEmail;

final readonly class InMemoryEmailService implements EmailService
{
    /** @var list<string, <EmailTemplate>> */
    public array $sentEmails;

    public function send(EmailTemplate $emailTemplate, UserEmail $userEmail): void
    {
        $this->sentEmails[$userEmail->value()][] = $emailTemplate;
    }
}