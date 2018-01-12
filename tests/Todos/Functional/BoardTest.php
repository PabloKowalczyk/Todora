<?php

declare(strict_types=1);

namespace Todora\Tests\Todos\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
                'PHP_AUTH_PW'   => $_ENV['ADMIN_PASSWORD'],
            ]
        );

        $response = $client->getResponse();

        $this->assertSame(200, $response->getStatusCode());
    }
}
