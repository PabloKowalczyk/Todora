<?php

declare(strict_types=1);

namespace Todora\Todos\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Todora\Todos\Domain\Model\User\User;
use Todora\Todos\Domain\Model\User\UserRepositoryInterface;

final class OrmUserRepository implements UserRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(User $user): void
    {
        $this->entityManager
            ->persist($user)
        ;
    }
}
