<?php

declare(strict_types=1);

namespace Todora\Domain;

use Ramsey\Uuid\UuidInterface;
use Todora\Domain\Task\Description;

class Task
{
    /**
     * @var Description
     */
    private $description;
    /**
     * @var Project
     */
    private $project;
    /**
     * @var UuidInterface
     */
    private $id;
    /**
     * @var \DateTime
     */
    private $createdAt;
    /**
     * @var bool
     */
    private $done;

    private function __construct(
        UuidInterface $id,
        Description $description,
        Project $project
    ) {
        $this->id = $id;
        $this->description = $description;
        $this->project = $project;
        $this->createdAt = new \DateTime();
        $this->done = false;
    }

    public static function create(
        UuidInterface $id,
        Description $description,
        Project $project
    ): self {
        return new self(
            $id,
            $description,
            $project
        );
    }
}
