<?php

declare(strict_types=1);

namespace Todora\Application\Query\Task;

class TaskView implements \JsonSerializable
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $projectId;
    /**
     * @var string
     */
    private $description;
    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;
    /**
     * @var bool
     */
    private $done;

    public function __construct(
        string $id,
        string $projectId,
        string $description,
        string $createdAt,
        bool $done
    ) {
        $this->id = $id;
        $this->projectId = $projectId;
        $this->description = $description;
        $this->createdAt = new \DateTimeImmutable($createdAt);
        $this->done = $done;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function projectId(): string
    {
        return $this->projectId;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function createdAt(): string
    {
        return $this->createdAt
            ->format(DATE_ATOM);
    }

    public function done()
    {
        return $this->done;
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id(),
            "projectId" => $this->projectId(),
            "createdAt" => $this->createdAt(),
            "description" => $this->description(),
            "done" => $this->done()
        ];
    }
}
