<?php

declare(strict_types=1);

namespace Todora\Tests\TestCase\Entity;

use Todora\SharedKernel\Domain\TodoraId;
use Todora\Todos\Domain\Service\AddUser\PasswordHasherInterface;

final class User
{
    /** @var TodoraId */
    private $todoraId;
    /** @var string */
    private $email;
    /** @var string */
    private $passwordRaw;
    /** @var string */
    private $passwordHash;
    /** @var string */
    private $username;
    /** @var \DateTimeImmutable */
    private $createdAt;
    /** @var array */
    private $roles;
    /** @var bool */
    private $verified;

    public function __construct(
        PasswordHasherInterface $passwordHasher,
        TodoraId $todoraId,
        string $email,
        string $passwordRaw,
        string $username,
        bool $verified,
        array $roles = []
    ) {
        $this->todoraId = $todoraId;
        $this->email = $email;
        $this->passwordRaw = $passwordRaw;
        $this->passwordHash = $passwordHasher->hash($passwordRaw);
        $this->username = $username;
        $this->createdAt = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
        $this->roles = $roles;
        $this->verified = $verified;
    }

    public function id(): string
    {
        return $this->todoraId
            ->toString()
        ;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function passwordRaw(): string
    {
        return $this->passwordRaw;
    }

    public function passwordHash(): string
    {
        return $this->passwordHash;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function createdAt(): string
    {
        return $this->createdAt
            ->format('Y-m-d H:i:s.u')
        ;
    }

    public function roles(): array
    {
        return $this->roles;
    }

    public function verified(): bool
    {
        return $this->verified;
    }
}
