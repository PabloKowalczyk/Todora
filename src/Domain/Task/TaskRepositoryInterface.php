<?php

declare(strict_types=1);

namespace Todora\Domain\Task;

use Ramsey\Uuid\UuidInterface;
use Todora\Domain\Task;

interface TaskRepositoryInterface
{
    public function addTask(Task $task): void;

    public function getTask(UuidInterface $id): Task;
}
