<?php

declare(strict_types=1);

namespace Todora\Todos\Application\Command;

use Todora\SharedKernel\Domain\TodoraId;

class RegisterUser
{
    /** @var ?string */
    private $username;
    /** @var ?string */
    private $email;
    /** @var ?string */
    private $password;
    /** @var ?string */
    private $repeatPassword;
    /** @var TodoraId */
    private $userId;

    public function __construct(TodoraId $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): TodoraId
    {
        return $this->userId;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getRepeatPassword(): ?string
    {
        return $this->repeatPassword;
    }

    public function setRepeatPassword($repeatPassword): void
    {
        $this->repeatPassword = $repeatPassword;
    }
}
