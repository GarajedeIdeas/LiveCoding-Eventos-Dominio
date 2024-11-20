<?php

declare(strict_types=1);

namespace Gdi\Shared\Domain\Exception;

use Exception;

final class MissingDomainEventSubscriber extends Exception
{
    public static function subscriberNotFound(int $id): self
    {
        return new self("Subscriber with id <$id> not found in DomainEventRecorder");
    }

    public static function noSubscribers(): self
    {
        return new self('Cannot record DomainEvents as no subscribers available in DomainEventRecorder');
    }
}
