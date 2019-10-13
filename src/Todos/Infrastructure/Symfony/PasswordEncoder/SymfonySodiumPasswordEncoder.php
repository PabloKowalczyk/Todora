<?php

declare(strict_types=1);

namespace Todora\Todos\Infrastructure\Symfony\PasswordEncoder;

use Symfony\Component\Security\Core\Encoder\Argon2iPasswordEncoder;
use Todora\Todos\Domain\Service\AddUser\PasswordHasherInterface;

final class SymfonySodiumPasswordEncoder implements PasswordHasherInterface
{
    /** @var Argon2iPasswordEncoder */
    private $argon2iPasswordEncoder;

    public function __construct(Argon2iPasswordEncoder $argon2iPasswordEncoder)
    {
        $this->argon2iPasswordEncoder = $argon2iPasswordEncoder;
    }

    public function hash(string $password): string
    {
        return $this->argon2iPasswordEncoder
            ->encodePassword($password, '')
        ;
    }
}
