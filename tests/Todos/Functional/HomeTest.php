<?php

declare(strict_types=1);

namespace Todora\Tests\Todos\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeTest extends WebTestCase
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
