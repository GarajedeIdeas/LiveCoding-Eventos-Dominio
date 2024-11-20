<?php

declare(strict_types=1);

namespace Gdi\Shared\Domain\ValueObject;

use Gdi\Shared\Domain\Exception\EmptyString;
use Stringable;

use function is_string;

abstract class NonEmptyString implements Stringable
{
    /**
     * @throws EmptyString
     */
    final private function __construct(protected readonly string $value)
    {
        $this->guardIsNotEmpty($value);
    }

    /**
     * @throws EmptyString
     */
    public static function create(string $value): static
    {
        return new static($value);
    }

    public static function createOrNullIfEmpty(?string $value): ?static
    {
        return is_string($value) && $value !== ''
            ? static::create($value)
            : null;
    }

    public function hasValue(string $value): bool
    {
        return $this->value === $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param static $other
     */
    public function equals($other): bool
    {
        return $other instanceof static && $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * @throws EmptyString
     */
    private function guardIsNotEmpty(string $value): void
    {
        if ($value === '') {
            throw EmptyString::throw(static::class);
        }
    }
}
