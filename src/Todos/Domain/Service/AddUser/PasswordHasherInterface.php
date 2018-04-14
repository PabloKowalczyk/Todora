<?php

declare(strict_types=1);

namespace Todora\Todos\Domain\Service\AddUser;

interface PasswordHasherInterface
{
    public function hash(string $password): string;
}
