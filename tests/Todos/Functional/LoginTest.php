<?php

declare(strict_types=1);

namespace Todora\Tests\Todos\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Todora\Tests\Traits\FixtureLoaderTrait;

class LoginTest extends WebTestCase
{
    use FixtureLoaderTrait;

    /** @test */
    public function userCanLogin(): void
    {
        $client = self::createClient();

        $this->loadFixture('user');

        $crawler = $client->request('get', 'login');
        $response = $client->getResponse();

        $this->assertSame(200, $response->getStatusCode());

        $formNode = $crawler->filter('#login-form');

        $form = $formNode->form(['_username' => 'admin@example.com', '_password' => 'admin']);

        $crawler = $client->submit($form);
        $response = $client->getResponse();

        $this->assertSame(302, $response->getStatusCode());

        $crawler = $client->followRedirect();

        $this->assertSame('http://localhost/board', $crawler->getUri());
    }
}
