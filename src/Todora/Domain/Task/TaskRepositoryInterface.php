<?php

declare(strict_types=1);

namespace Todora\Domain\Task;

use Todora\Domain\Task;

interface TaskRepositoryInterface
{
    public function addTask(Task $task): void;
}
