<?php

declare(strict_types=1);

namespace Gdi\Api\User\Domain\Entity;

use Gdi\Api\User\Domain\ValueObject\UserId;
use Gdi\Api\User\Domain\ValueObject\UserProfileId;
use Gdi\Api\User\Domain\ValueObject\UserProfileName;
use Gdi\Shared\Domain\Exception\EmptyString;

final readonly class UserProfile
{
    public function __construct(
        private UserProfileId $id,
        private UserId $userId,
        private UserProfileName $name,
        private bool $isMain
    ) {
    }

    public static function create(
        UserProfileId $id,
        UserId $userId,
        UserProfileName $name,
        bool $isMain
    ): self {
        return new self($id, $userId, $name, $isMain);
    }

    /**
     * @throws EmptyString
     */
    public static function createDefaultMain(
        UserProfileId $id,
        UserId $userId
    ): self {
        return self::create(
            $id,
            $userId,
            UserProfileName::defaultMain(),
            true
        );
    }

    public function id(): UserProfileId
    {
        return $this->id;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function name(): UserProfileName
    {
        return $this->name;
    }

    public function isMain(): bool
    {
        return $this->isMain;
    }
}
