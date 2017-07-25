<?php

declare(strict_types=1);

namespace Todora\Domain\Project;

use Assert\Assertion;

class Name
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        Assertion::betweenLength(
            $name,
            1,
            255,
            "Project name must be between 1 and 255 length."
        );

        $this->name = $name;
    }
}
