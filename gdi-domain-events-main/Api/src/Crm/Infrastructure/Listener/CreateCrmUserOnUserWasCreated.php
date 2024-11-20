<?php

namespace Gdi\Api\Crm\Infrastructure\Listener;

use Gdi\Api\Crm\Application\CreateCrmUser;
use Gdi\Api\User\Domain\Event\UserWasCreated;
use Gdi\Api\User\Domain\ValueObject\UserEmail;
use Gdi\Api\User\Domain\ValueObject\UserId;
use Gdi\Shared\Domain\Event\AsyncDomainEventListener;

final readonly class CreateCrmUserOnUserWasCreated implements AsyncDomainEventListener
{
    public function __construct(private CreateCrmUser $createCrmUser)
    {
    }

    public function __invoke(UserWasCreated $event): void
    {
        $userId = UserId::create($event->userId);
        $userEmail = UserEmail::create($event->userEmail);

        $this->createCrmUser->__invoke($userId, $userEmail);
    }
}