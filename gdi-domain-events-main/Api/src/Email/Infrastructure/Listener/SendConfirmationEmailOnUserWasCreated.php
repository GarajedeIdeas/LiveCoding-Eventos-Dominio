<?php

namespace Gdi\Api\Email\Infrastructure\Listener;

use Gdi\Api\Email\Application\SendConfirmationEmail;
use Gdi\Api\User\Domain\Event\UserWasCreated;
use Gdi\Api\User\Domain\ValueObject\UserEmail;
use Gdi\Shared\Domain\Event\AsyncDomainEventListener;

final readonly class SendConfirmationEmailOnUserWasCreated implements AsyncDomainEventListener
{
    public function __construct(private SendConfirmationEmail $sendConfirmationEmail)
    {
    }

    public function __invoke(UserWasCreated $event): void
    {
        $userEmail = UserEmail::create($event->userEmail);

        $this->sendConfirmationEmail->__invoke($userEmail);
    }
}