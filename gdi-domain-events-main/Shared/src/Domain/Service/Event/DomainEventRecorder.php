<?php

declare(strict_types=1);

namespace Gdi\Shared\Domain\Service\Event;

use BadMethodCallException;

use Gdi\Shared\Domain\Event\DomainEvent;

use Gdi\Shared\Domain\Exception\MissingDomainEventSubscriber;

use function array_search;
use function array_splice;
use function array_unshift;
use function is_int;
use function mt_rand;

final class DomainEventRecorder
{
    /** @var array<int,InMemoryDomainEventRecorderSubscriber> */
    private array $subscribers = [];

    /** @var list<int> */
    private array $activeSubscriberIds = [];

    private static ?DomainEventRecorder $instance;

    private function __construct()
    {
    }

    public static function instance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @throws BadMethodCallException
     */
    public function __clone()
    {
        throw new BadMethodCallException('Clone is not supported');
    }

    public function subscribeReturningId(InMemoryDomainEventRecorderSubscriber $subscriber): int
    {
        $id = mt_rand();

        $this->subscribers[$id] = $subscriber;
        array_unshift($this->activeSubscriberIds, $id);

        return $id;
    }

    /**
     * @throws MissingDomainEventSubscriber
     */
    public function unsubscribe(int $id): void
    {
        $activePosition = array_search($id, $this->activeSubscriberIds, true);
        if (!is_int($activePosition)) {
            throw MissingDomainEventSubscriber::subscriberNotFound($id);
        }

        array_splice($this->activeSubscriberIds, $activePosition, 1);
        unset($this->subscribers[$id]);
    }

    public function record(DomainEvent $domainEvent): void
    {
        foreach ($this->activeSubscriberIds as $activeSubscriberId) {
            $this->subscribers[$activeSubscriberId]->add($domainEvent);

            return;
        }
    }

    public function __destruct()
    {
        self::$instance = null;
    }
}
