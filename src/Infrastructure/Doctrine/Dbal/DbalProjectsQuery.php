<?php

declare(strict_types=1);

namespace Todora\Infrastructure\Doctrine\Dbal;

use Assert\Assertion;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\UuidInterface;
use Todora\Application\Query\Project\ProjectsQueryInterface;
use Todora\Application\Query\Project\ProjectsView;
use Todora\Application\Query\Project\ProjectView;
use Todora\Application\Query\Task\TasksQueryInterface;
use Todora\Application\Query\Task\TaskView;

class DbalProjectsQuery implements ProjectsQueryInterface
{
    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var TasksQueryInterface
     */
    private $tasksQuery;

    public function __construct(Connection $connection, TasksQueryInterface $tasksQuery)
    {
        $this->connection = $connection;
        $this->tasksQuery = $tasksQuery;
    }

    public function findAll(): ProjectsView
    {
        $queryBuilder = $this->connection
            ->createQueryBuilder();

        $queryBuilder->select("p.id", "p.name_name", "p.created_at")
            ->from("projects", "p")
            ->orderBy("created_at", "DESC");

        $projectsData = $this->connection
            ->fetchAll($queryBuilder->getSQL());

        $projectIds = array_map(
            function ($projectData) {
                return $projectData["id"];
            },
            $projectsData
        );

        $projectTasks = $this->tasksQuery
            ->findProjectsTasks($projectIds);

        return new ProjectsView(
            ...array_map(
                function ($projectData) use($projectTasks) {
                    $currentProjectTasksData = array_filter(
                        $projectTasks->getTaskView(),
                        function (TaskView $taskView) use ($projectData) {
                            return $projectData["id"] === $taskView->projectId();
                        }
                    );

                    return $this->hydrateProject($projectData, $currentProjectTasksData);
                },
                $projectsData
            )
        );
    }

    public function getProject(UuidInterface $uuid): ProjectView
    {
        $queryBuilder = $this->connection
            ->createQueryBuilder();

        $queryBuilder
            ->select("*")
            ->from("projects", "p")
            ->where("p.id = :id")
            ->setParameter("id", $uuid->toString());

        $projectData = $this->connection
            ->fetchAssoc(
                $queryBuilder->getSQL(),
                $queryBuilder->getParameters(),
                $queryBuilder->getParameterTypes()
            );

        Assertion::notEmpty($projectData);

        return $this->hydrateProject($projectData);
    }

    private function hydrateProject(array $projectData, array $tasks = []): ProjectView
    {
        return new ProjectView(
            $projectData["id"],
            $projectData["name_name"],
            $projectData["created_at"],
            ...$tasks
        );
    }
}
