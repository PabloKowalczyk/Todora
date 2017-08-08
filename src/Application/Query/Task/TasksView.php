<?php

declare(strict_types=1);

namespace Todora\Application\Query\Task;

class TasksView
{
    /**
     * @var TaskView[]
     */
    private $taskView;

    public function __construct(TaskView ...$taskView)
    {
        $this->taskView = $taskView;
    }

    /**
     * @return TaskView[]
     */
    public function getTaskView(): array
    {
        return $this->taskView;
    }
}
