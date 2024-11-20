<?php

declare(strict_types=1);

namespace Gdi\Shared\Domain\Service\Event;

use Gdi\Shared\Domain\Event\DomainEvent;

final class InMemoryDomainEventRecorderSubscriber
{
    /** @var list<DomainEvent> */
    private array $events = [];

    public function add(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return list<DomainEvent>
     */
    public function events(): array
    {
        return $this->events;
    }
}
