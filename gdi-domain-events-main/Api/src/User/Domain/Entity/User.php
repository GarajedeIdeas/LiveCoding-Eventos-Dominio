<?php

declare(strict_types=1);

namespace Gdi\Api\User\Domain\Entity;

use Gdi\Api\User\Domain\Event\UserWasCreated;
use Gdi\Api\User\Domain\ValueObject\UserEmail;
use Gdi\Api\User\Domain\ValueObject\UserId;
use Gdi\Shared\Domain\Service\Event\DomainEventRecorder;

final readonly class User
{
    public function __construct(
        private UserId $id,
        private UserEmail $email
    ) {
    }

    public static function create(
        UserId $id,
        UserEmail $email
    ): self {
        $user = new self(
            $id,
            $email
        );

        DomainEventRecorder::instance()->record(
            new UserWasCreated(
                $id->value(),
                $email->value()
            )
        );

        return $user;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }
}
