<?php

declare(strict_types=1);

namespace Todora\SharedKernel\Infrastructure\CommandBus;

use League\Tactician\CommandBus;
use Todora\SharedKernel\Application\CommandBusInterface;

class TacticianCommandBus implements CommandBusInterface
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function handle(object $command): void
    {
        $this->commandBus
            ->handle($command)
        ;
    }
}
