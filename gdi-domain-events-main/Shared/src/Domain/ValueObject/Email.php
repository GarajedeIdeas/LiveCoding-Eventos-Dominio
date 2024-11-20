<?php

declare(strict_types=1);

namespace Gdi\Shared\Domain\ValueObject;

use Gdi\Shared\Domain\Exception\InvalidEmailFormat;
use Gdi\Shared\Domain\Exception\InvalidLength;

use function filter_var;
use function is_string;
use function strlen;

use const FILTER_VALIDATE_EMAIL;

abstract class Email
{
    protected const int MAX_LENGTH = 254;

    protected string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @throws InvalidEmailFormat
     * @throws InvalidLength
     */
    public static function create(string $email): static
    {
        static::validateOrFail($email);

        return new static($email);
    }

    public static function createOrNullIfEmpty(?string $value): ?static
    {
        return is_string($value) && $value !== ''
            ? static::create($value)
            : null;
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

    public static function isValid(string $email): bool
    {
        try {
            self::validateOrFail($email);
        } catch (InvalidLength | InvalidEmailFormat) {
            return false;
        }

        return true;
    }

    /**
     * @throws InvalidLength
     * @throws InvalidEmailFormat
     */
    private static function validateOrFail(string $email): void
    {
        self::validateMaxLengthOrFail($email);
        self::validateEmailFormatOrFail($email);
    }

    /**
     * @throws InvalidLength
     */
    private static function validateMaxLengthOrFail(string $email): void
    {
        $emailLength = strlen($email);
        if ($emailLength > self::MAX_LENGTH) {
            throw InvalidLength::exceedsWithParamValueAndLimit('email', $emailLength, self::MAX_LENGTH);
        }
    }

    /**
     * @throws InvalidEmailFormat
     */
    private static function validateEmailFormatOrFail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailFormat::withValue($email);
        }
    }
}
