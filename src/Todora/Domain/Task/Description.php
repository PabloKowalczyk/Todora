<?php

declare(strict_types=1);

namespace Todora\Domain\Task;

use Assert\Assertion;

class Description
{
    /**
     * @var string
     */
    private $description;

    public function __construct(string $description)
    {
        Assertion::betweenLength(
            $description,
            1,
            255,
            "Task description must be between 1 and 255 length."
        );

        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
