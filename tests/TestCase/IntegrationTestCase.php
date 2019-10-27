<?php

declare(strict_types=1);

namespace Todora\Tests\TestCase;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Todora\Tests\TestCase\EntityLoader\EntityLoaderInterface;
use Todora\Todos\Domain\Service\AddUser\PasswordHasherInterface;

abstract class IntegrationTestCase extends WebTestCase
{
    private const SERVICE_ID_PASSWORD_HASHER = 'passowrd_hasher';

    protected function loadEntities(object ...$entities): void
    {
        /** @var EntityLoaderInterface $entityLoader */
        $entityLoader = self::$container->get(EntityLoaderInterface::class);
        $entityLoader->loadEntities(...$entities);
    }

    protected function passwordHasher(): PasswordHasherInterface
    {
        return self::$container->get(self::SERVICE_ID_PASSWORD_HASHER);
    }
}
