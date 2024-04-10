<?php

declare(strict_types=1);

namespace App\Tests\Suit\Integration\Service\FizzBuzzGenerator;

use App\Service\FizzBuzzGenerator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class FizzBuzzGeneratorTest extends KernelTestCase
{
    /**
     * @dataProvider \App\Tests\Shared\IntervalProvider::rightValues
     */
    public function testCreateFizzBuzz($init, $end, $expected): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $fizzBuzzGenerator = $container->get(FizzBuzzGenerator::class);
        $this->assertInstanceOf(FizzBuzzGenerator::class, $fizzBuzzGenerator);
        $fizzBuzz = $fizzBuzzGenerator->__invoke($init, $end);
        $this->assertEquals($expected, $fizzBuzz);
    }
}
