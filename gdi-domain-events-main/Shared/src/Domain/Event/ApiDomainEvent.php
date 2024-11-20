<?php

declare(strict_types=1);

namespace Gdi\Shared\Domain\Event;

use JsonSerializable;

use function sprintf;

abstract class ApiDomainEvent implements DomainEvent, JsonSerializable
{
    private const string NAME_PREFIX = 'gdi.api.domain_event';

    public int $occurredOn;

    public function __construct()
    {
        $this->occurredOn = time();
    }

    public function occurredOn(): int
    {
        return $this->occurredOn;
    }

    public static function name(): string
    {
        return sprintf(
            '%s.%d.%s',
            self::NAME_PREFIX,
            static::version(),
            static::eventName()
        );
    }

    abstract protected static function version(): int;

    abstract protected static function eventName(): string;
}
