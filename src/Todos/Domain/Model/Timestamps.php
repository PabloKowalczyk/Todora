<?php

declare(strict_types=1);

namespace Todora\Todos\Domain\Model;

final class Timestamps
{
    /** @var \DateTimeImmutable */
    private $createdAt;
    /** @var \DateTimeImmutable */
    private $updatedAt;

    private function __construct(\DateTimeImmutable $createdAt, \DateTimeImmutable $updatedAt)
    {
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function create(): self
    {
        return new self(new \DateTimeImmutable(), new \DateTimeImmutable());
    }

    public function wasUpdated(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}
