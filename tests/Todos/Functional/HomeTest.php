<?php

declare(strict_types=1);

namespace Todora\Tests\Todos\Functional;

use Symfony\Component\HttpFoundation\Response;
use Todora\Tests\TestCase\IntegrationTestCase;

final class HomeTest extends IntegrationTestCase
{
    /** @test */
    public function pageIsAccessible(): void
    {
        $client = self::createClient();
        $client->request('get', '/');

        /** @var Response $response */
        $response = $client->getResponse();

        $this->assertNotNull($response);
        $this->assertSame(200, $response->getStatusCode());
    }
}
