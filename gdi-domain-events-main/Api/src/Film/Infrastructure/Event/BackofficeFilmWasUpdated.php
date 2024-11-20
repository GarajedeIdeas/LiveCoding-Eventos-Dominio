<?php

namespace Gdi\Api\Film\Infrastructure\Event;

use Gdi\Shared\Infrastructure\Event\BackofficeDomainEvent;

final class BackofficeFilmWasUpdated extends BackofficeDomainEvent
{
    public function __construct(
        public string $filmId
    ) {
        parent::__construct();
    }

    protected static function eventName(): string
    {
        return 'film.updated';
    }

    protected static function version(): int
    {
        return 1;
    }
}