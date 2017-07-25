<?php

declare(strict_types=1);

namespace Tests\Functional\UserInterface;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BoardControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client
            ->request("GET", "/");

        $response = $client->getResponse();

        $headerElement = $crawler->filter("p");

        $this->assertSame(200, $response->getStatusCode());
        $this->assertCount(1, $headerElement);
        $this->assertContains("Works", $headerElement->text());
    }
}
