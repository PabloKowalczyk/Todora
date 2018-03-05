<?php

declare(strict_types=1);

namespace Todora\SharedKernel\Application;

interface CommandBusInterface
{
    public function handle(object $command): void;
}
