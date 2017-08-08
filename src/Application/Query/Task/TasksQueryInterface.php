<?php

declare(strict_types=1);

namespace Todora\Application\Query\Task;

use Ramsey\Uuid\UuidInterface;

interface TasksQueryInterface
{
    public function findProjectsTasks(array $projectIds): TasksView;

    public function getTask(UuidInterface $uuid): TaskView;
}
