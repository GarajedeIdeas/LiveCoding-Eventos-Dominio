<?php

namespace Gdi\Backoffice\Film\Domain\Event;

use Gdi\Shared\Infrastructure\Event\BackofficeDomainEvent;

final class FilmWasUpdated extends BackofficeDomainEvent
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

    public function jsonSerialize(): array
    {
        return [
            'eventName' => self::eventName(),
            'version' => self::version(),
            'filmId' => $this->filmId,
            'occurredOn' => $this->occurredOn,
        ];
    }
}