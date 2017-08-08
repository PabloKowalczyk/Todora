<?php

declare(strict_types=1);

namespace Todora\Application\Command;

use Ramsey\Uuid\UuidInterface;

class RenameProject
{
    /**
     * @var UuidInterface
     */
    private $projectId;
    /**
     * @var string
     */
    private $newName;

    public function __construct(UuidInterface $projectId, string $newName)
    {
        $this->projectId = $projectId;
        $this->newName = $newName;
    }

    public function projectId(): UuidInterface
    {
        return $this->projectId;
    }

    public function newName(): string
    {
        return $this->newName;
    }
}
