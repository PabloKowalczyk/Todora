<?php

declare(strict_types=1);

namespace Todora\Tests\TestCase\EntityLoader;

interface EntityLoaderInterface
{
    /** @var string[] */
    public const TABLES_TO_PURGE = ['users'];

    public function loadEntities(object ...$entities): void;

    public function purge(): void;
}
