<?php

declare(strict_types=1);

namespace Gdi\Shared\Domain\Event;

interface DomainEvent
{
    public function occurredOn(): int;

    public static function name(): string;
}
