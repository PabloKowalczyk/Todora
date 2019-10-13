<?php

declare(strict_types=1);

namespace Todora\Todos\Infrastructure\Symfony\PasswordEncoder;

use Symfony\Component\Security\Core\Encoder\SodiumPasswordEncoder;
use Todora\Todos\Domain\Service\AddUser\PasswordHasherInterface;

final class SymfonySodiumPasswordEncoder implements PasswordHasherInterface
{
    /** @var SodiumPasswordEncoder */
    private $sodiumPasswordEncoder;

    public function __construct(SodiumPasswordEncoder $sodiumPasswordEncoder)
    {
        $this->sodiumPasswordEncoder = $sodiumPasswordEncoder;
    }

    public function hash(string $password): string
    {
        return $this->sodiumPasswordEncoder
            ->encodePassword($password, null)
        ;
    }
}
