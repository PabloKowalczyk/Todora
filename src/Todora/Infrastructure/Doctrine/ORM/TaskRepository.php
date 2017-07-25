<?php

declare(strict_types=1);

namespace Todora\Infrastructure\Doctrine\ORM;

use Doctrine\ORM\EntityManagerInterface;
use Todora\Domain\Task;
use Todora\Domain\Task\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addTask(Task $task): void
    {
        $this->entityManager
            ->persist($task);
    }
}
