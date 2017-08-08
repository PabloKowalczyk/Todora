<?php

declare(strict_types=1);

namespace Todora\Application\Command;

use Ramsey\Uuid\UuidInterface;

class CreateNewTask
{
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $projectId;
    /**
     * @var UuidInterface
     */
    private $uuid;

    public function __construct(
        UuidInterface $uuid,
        string $description,
        string $projectId
    ) {
        $this->description = $description;
        $this->projectId = $projectId;
        $this->uuid = $uuid;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function projectId(): string
    {
        return $this->projectId;
    }

    public function id(): UuidInterface
    {
        return $this->uuid;
    }
}
