<?php

declare(strict_types=1);

namespace Gdi\Backoffice\Film\Domain\Exception;

use Exception;
use Gdi\Backoffice\Film\Domain\ValueObject\FilmId;

final class FilmNotFound extends Exception
{
    public static function ofId(FilmId $id): self
    {
        return new self(sprintf('Film with id "%s" not found', $id->value()));
    }
}
