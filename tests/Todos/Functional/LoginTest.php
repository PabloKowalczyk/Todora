<?php

declare(strict_types=1);

namespace Todora\Tests\Todos\Functional;

use Symfony\Component\HttpFoundation\Response;
use Todora\SharedKernel\Domain\TodoraId;
use Todora\Tests\TestCase\Entity\User;
use Todora\Tests\TestCase\IntegrationTestCase;

final class LoginTest extends IntegrationTestCase
{
    /** @test */
    public function userCanLogin(): void
    {
        $client = self::createClient();
        $todoraId = TodoraId::create();
        $user = new User(
            $this->passwordHasher(),
            $todoraId,
            'mail@mail.com',
            'password',
            'some-user',
            true
        );
        $this->loadEntities($user);

        $crawler = $client->request('get', 'login');

        /** @var Response $response */
        $response = $client->getResponse();

        $this->assertNotNull($response);
        $this->assertSame(200, $response->getStatusCode());

        $formNode = $crawler->filter('#login-form');

        $form = $formNode->form(['_username' => 'mail@mail.com', '_password' => 'password']);

        $crawler = $client->submit($form);
        /** @var Response $response */
        $response = $client->getResponse();

        $this->assertNotNull($response);
        $this->assertSame(302, $response->getStatusCode());

        $crawler = $client->followRedirect();

        $this->assertSame('http://localhost/board', $crawler->getUri());
    }
}
