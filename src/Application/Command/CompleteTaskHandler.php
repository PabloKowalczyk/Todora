<?php

declare(strict_types=1);

namespace Todora\Application\Command;

use Ramsey\Uuid\Uuid;
use Todora\Domain\Task\TaskRepositoryInterface;

class CompleteTaskHandler
{
    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function handle(CompleteTask $completeTask)
    {
        $taskId = Uuid::fromString($completeTask->taskId());

        $task = $this->taskRepository
            ->getTask($taskId);

        $task->complete();
    }
}
