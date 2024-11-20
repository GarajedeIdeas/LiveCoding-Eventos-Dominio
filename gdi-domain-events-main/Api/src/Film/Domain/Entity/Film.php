<?php

declare(strict_types=1);

namespace Gdi\Api\Film\Domain\Entity;

use Gdi\Api\Film\Domain\ValueObject\FilmId;
use Gdi\Api\Film\Domain\ValueObject\FilmTitle;

final class Film
{
    public function __construct(
        private readonly FilmId $id,
        private FilmTitle $title
    ) {
    }

    public static function create(
        FilmId $id,
        FilmTitle $title
    ): self {
        return new self(
            $id,
            $title
        );
    }

    public function id(): FilmId
    {
        return $this->id;
    }

    public function title(): FilmTitle
    {
        return $this->title;
    }

    public function updateTitle(FilmTitle $title): void
    {
        $this->title = $title;
    }
}
