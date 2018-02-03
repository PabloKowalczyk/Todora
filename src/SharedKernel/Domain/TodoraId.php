<?php

declare(strict_types=1);

namespace Todora\SharedKernel\Domain;

use Ramsey\Uuid\Uuid;

final class TodoraId
{
    /** @var string */
    private $id;

    private function __construct()
    {
        $this->id = (Uuid::uuid4())->toString();
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public static function create(): self
    {
        return new self();
    }
}
