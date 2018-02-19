<?php

declare(strict_types=1);

namespace Todora\Todos\Application\Query;

class UniqueUsernameView
{
    /** @var int */
    private $count;

    public function __construct(int $count)
    {
        $this->count = $count;
    }

    public function isUnique(): bool
    {
        return $this->count === 0;
    }
}
