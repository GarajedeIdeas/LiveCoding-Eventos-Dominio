<?php

declare(strict_types=1);

namespace Gdi\Api\User\Infrastructure\Listener;

use Gdi\Api\User\Application\CreateUserDefaultMainProfile;
use Gdi\Api\User\Domain\Event\UserWasCreated;
use Gdi\Api\User\Domain\ValueObject\UserId;
use Gdi\Shared\Domain\Event\SyncDomainEventListener;
use Gdi\Shared\Domain\Exception\EmptyString;

final readonly class CreateDefaultMainProfileOnUserWasCreated implements SyncDomainEventListener
{
    public function __construct(private CreateUserDefaultMainProfile $createUserDefaultMainProfile)
    {
    }

    /**
     * @throws EmptyString
     */
    public function __invoke(UserWasCreated $event): void
    {
        $userId = UserId::create($event->userId);

        $this->createUserDefaultMainProfile->__invoke($userId);
    }
}
