<?php

declare(strict_types=1);

namespace App\Tests\Suit\E2E\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FizzBuzzControllerTest extends WebTestCase
{
    /**
     * @dataProvider \App\Tests\Shared\IntervalProvider::rightValues
     */
    public function testCreateFizzBuzz($init, $end, $expected): void
    {
        $client = static::createClient();

        $client->request(
            'GET',
            '/desafio/fizz/buzz',
        );
        $crawler = $client->submitForm('fizz_buzz_submit',
            [
                'fizz_buzz[ini]' => $init,
                'fizz_buzz[end]' => $end
            ]
        );
        self::assertResponseIsSuccessful();
        $result = $crawler->filter('#result')->text();
        self::assertEquals($expected, $result);
    }
}
