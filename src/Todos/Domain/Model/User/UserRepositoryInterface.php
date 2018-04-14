<?php

declare(strict_types=1);

namespace Todora\Todos\Domain\Model\User;

interface UserRepositoryInterface
{
    public function add(User $user): void;
}
