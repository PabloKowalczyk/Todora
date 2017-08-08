<?php

declare(strict_types=1);

namespace Todora\Application\Command;

class CompleteTask
{
    /**
     * @var null|string
     */
    private $taskId;

    public function __construct(?string $taskId)
    {
        $this->taskId = $taskId;
    }

    public function taskId(): ?string
    {
        return $this->taskId;
    }
}
