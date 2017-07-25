<?php

declare(strict_types=1);

namespace Todora\Application\Command;

use Ramsey\Uuid\Uuid;
use Todora\Domain\Project\ProjectRepositoryInterface;
use Todora\Domain\Task;

class CreateNewTaskHandler
{
    /**
     * @var ProjectRepositoryInterface
     */
    private $projectRepository;
    /**
     * @var Task\TaskRepositoryInterface
     */
    private $taskRepository;

    public function __construct(ProjectRepositoryInterface $doctrineProjects, Task\TaskRepositoryInterface $taskRepository)
    {
        $this->projectRepository = $doctrineProjects;
        $this->taskRepository = $taskRepository;
    }

    public function handle(CreateNewTask $command): void
    {
        $project = $this->projectRepository
            ->getProject(Uuid::fromString($command->projectId()));

        $task = Task::create(
            $command->id(),
            new Task\Description($command->description()),
            $project
        );

        $this->taskRepository
            ->addTask($task);
    }
}
