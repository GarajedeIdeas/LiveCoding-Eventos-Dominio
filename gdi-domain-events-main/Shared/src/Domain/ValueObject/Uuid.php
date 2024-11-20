<?php

declare(strict_types=1);

namespace Gdi\Shared\Domain\ValueObject;

use Gdi\Shared\Domain\Exception\InvalidUuidException;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Stringable;

abstract class Uuid implements Stringable
{
    private function __construct(protected string $value)
    {
        $this->validateOrFail($this->value);
    }

    public static function create(string $value): static
    {
        return new static($value);
    }

    public static function random(): static
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    public function hasValue(string $value): bool
    {
        return $this->value === $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }

    /**
     * @param static|null $other
     */
    public function equals(?Uuid $other): bool
    {
        return $other instanceof static && $this->value === $other->value;
    }

    public static function isValid(string $value): bool
    {
        return RamseyUuid::isValid($value);
    }

    public static function createOrNull(?string $value): ?self
    {
        if ($value === null) {
            return null;
        }

        return self::create($value);
    }


    /**
     * @throws InvalidUuidException
     */
    private function validateOrFail(string $value): void
    {
        if (!RamseyUuid::isValid($value)) {
            throw InvalidUuidException::withValue($value);
        }
    }
}
