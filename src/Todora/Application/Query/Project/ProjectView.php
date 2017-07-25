<?php

declare(strict_types=1);

namespace Todora\Application\Query\Project;

use Todora\Application\Query\Task\TaskView;

final class ProjectView implements \JsonSerializable
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var \DateTime
     */
    private $createdAt;
    /**
     * @var TaskView[]
     */
    private $tasksView;

    public function __construct(
        string $id,
        string $name,
        string $createdAt,
        TaskView ...$tasksView
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = new \DateTime($createdAt);
        $this->tasksView = $tasksView;
    }

    public function tasks(): array
    {
        return $this->tasksView;
    }

    public function createdAt(): string
    {
        return $this->createdAt
            ->format(DATE_ATOM);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id(),
            "name" => $this->name(),
            "createdAt" => $this->createdAt(),
            "tasks" => $this->tasks()
        ];
    }
}
