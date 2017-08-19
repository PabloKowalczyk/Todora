<?php

declare(strict_types=1);

namespace Todora\Infrastructure\Doctrine\Dbal;

use Assert\Assert;
use Assert\Assertion;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\UuidInterface;
use Todora\Application\Query\Task\TasksQueryInterface;
use Todora\Application\Query\Task\TasksView;
use Todora\Application\Query\Task\TaskView;

class DbalTaskQuery implements TasksQueryInterface
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findProjectsTasks(array $projectIds): TasksView
    {
        Assert::thatAll($projectIds)
            ->uuid();

        $queryBuilder = $this->connection
            ->createQueryBuilder();

        $queryBuilder->select("*")
            ->from("projects_tasks", "pt")
            ->where("pt.project_id IN (:projectIds)")
            ->orderBy("pt.created_at", "DESC")
            ->addOrderBy("pt.id", "DESC")
            ->setParameter("projectIds", $projectIds, Connection::PARAM_STR_ARRAY);

        $tasksData = $this->connection
            ->fetchAll(
                $queryBuilder->getSQL(),
                $queryBuilder->getParameters(),
                $queryBuilder->getParameterTypes()
            );

        return new TasksView(
            ...array_map(
                function ($taskData) {
                    return $this->hydrateTask($taskData);
                },
                $tasksData
            )
        );
    }

    public function getTask(UuidInterface $uuid): TaskView
    {
        $queryBuilder = $this->connection
            ->createQueryBuilder();

        $queryBuilder
            ->select("*")
            ->from("projects_tasks", "pt")
            ->where("pt.id = :id")
            ->setParameter("id", $uuid->toString());

        $taskData = $this->connection
            ->fetchAssoc(
                $queryBuilder->getSQL(),
                $queryBuilder->getParameters(),
                $queryBuilder->getParameterTypes()
            );

        Assertion::notEmpty($taskData);

        return $this->hydrateTask($taskData);
    }

    private function hydrateTask(array $taskData): TaskView
    {
        return new TaskView(
            $taskData["id"],
            $taskData["project_id"],
            $taskData["description"],
            $taskData["created_at"],
            $taskData["done"]
        );
    }
}
