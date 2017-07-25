<?php

declare(strict_types=1);

namespace Todora\Application\Command;

use Ramsey\Uuid\UuidInterface;

class CreateNewProject
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var UuidInterface
     */
    private $uuid;

    public function __construct(string $name, UuidInterface $uuid)
    {
        $this->name = $name;
        $this->uuid = $uuid;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function id(): UuidInterface
    {
        return $this->uuid;
    }
}
