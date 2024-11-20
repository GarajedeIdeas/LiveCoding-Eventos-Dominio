<?php

declare(strict_types=1);

namespace Gdi\Api\Film\Domain\Exception;

use Exception;
use Gdi\Api\Film\Domain\ValueObject\FilmId;

final class FilmNotFound extends Exception
{
    public static function ofId(FilmId $id): self
    {
        return new self(sprintf('Film with id "%s" not found', $id->value()));
    }
}
