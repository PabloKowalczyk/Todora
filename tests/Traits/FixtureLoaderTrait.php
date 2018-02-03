<?php

declare(strict_types=1);

namespace Todora\Tests\Traits;

use Fidry\AliceDataFixtures\LoaderInterface;

trait FixtureLoaderTrait
{
    private function loadFixture(string $name): void
    {
        /** @var \Symfony\Component\DependencyInjection\ContainerInterface $container */
        $container = self::$kernel->getContainer();

        /** @var LoaderInterface $loader */
        $loader = $container->get('fidry_alice_data_fixtures.loader.doctrine');
        $fixturesPath = $container->getParameter('kernel.project_dir');

        $fixturePath = "{$fixturesPath}/resources/fixtures/${name}.yaml";

        $loader->load([$fixturePath]);
    }
}
