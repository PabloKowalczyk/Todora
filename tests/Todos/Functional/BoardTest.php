<?php

declare(strict_types=1);

namespace Todora\Tests\Todos\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class BoardTest extends WebTestCase
{
    /** @test */
    public function boardIsAccessible(): void
    {
        $client = self::createClient();

        $client->request(
            'get',
            '/',
            [],
            [],
            [
                'PHP_AUTH_USER' => 'admin',
                'PHP_AUTH_PW' => $_ENV['ADMIN_PASSWORD'],
            ]
        );

        /** @var Response $response */
        $response = $client->getResponse();

        $this->assertNotNull($response);
        $this->assertSame(200, $response->getStatusCode());
    }
}
