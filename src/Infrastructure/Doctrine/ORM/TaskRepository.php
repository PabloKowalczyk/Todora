<?php

declare(strict_types=1);

namespace Todora\Infrastructure\Doctrine\ORM;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;
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

    public function getTask(UuidInterface $id): Task
    {
        $queryBuilder = $this->entityManager
            ->createQueryBuilder();

        $queryBuilder
            ->select("t")
            ->from(Task::class, "t")
            ->where("t.id = :id")
            ->setParameter("id", $id->toString());

        $query = $queryBuilder->getQuery();

        $task = $query->getSingleResult(AbstractQuery::HYDRATE_SIMPLEOBJECT);

        return $task;
    }
}
