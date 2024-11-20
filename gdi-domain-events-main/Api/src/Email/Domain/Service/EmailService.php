<?php

namespace Gdi\Api\Email\Domain\Service;

use Gdi\Api\Email\Domain\Template\EmailTemplate;
use Gdi\Api\User\Domain\ValueObject\UserEmail;

interface EmailService
{
    public function send(EmailTemplate $emailTemplate, UserEmail $userEmail): void;
}