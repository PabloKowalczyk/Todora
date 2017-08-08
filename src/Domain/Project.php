<?php

declare(strict_types=1);

namespace Todora\Domain;

use Ramsey\Uuid\UuidInterface;
use Todora\Domain\Project\Name;

class Project
{
    /**
     * @var \Ramsey\Uuid\UuidInterface
     */
    private $id;
    /**
     * @var Name
     */
    private $name;
    /**
     * @var \DateTime
     */
    private $createdAt;

    public static function create(UuidInterface $uuid, string $name): self
    {
        return new self($uuid, new Name($name));
    }

    private function __construct(UuidInterface $uuid, Name $name)
    {
        $this->id = $uuid;
        $this->name = $name;
        $this->createdAt = new \DateTime();
    }

    public function rename(string $newName): void
    {
        $this->name = new Name($newName);
    }
}
