<?php

namespace Gdi\Api\Email\Infrastructure\Listener;

use Gdi\Api\Email\Application\SendWelcomeEmail;
use Gdi\Api\User\Domain\Event\UserWasCreated;
use Gdi\Api\User\Domain\ValueObject\UserEmail;
use Gdi\Shared\Domain\Event\AsyncDomainEventListener;

final readonly class SendWelcomeEmailOnUserWasCreated implements AsyncDomainEventListener
{
    public function __construct(private SendWelcomeEmail $sendWelcomeEmail)
    {
    }

    public function __invoke(UserWasCreated $event): void
    {
        $userEmail = UserEmail::create($event->userEmail);

        $this->sendWelcomeEmail->__invoke($userEmail);
    }
}