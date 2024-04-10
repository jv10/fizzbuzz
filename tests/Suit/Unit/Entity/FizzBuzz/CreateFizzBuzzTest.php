<?php

declare(strict_types=1);

namespace App\Tests\Suit\Unit\Entity\FizzBuzz;

use App\Entity\FizzBuzz;
use App\Tests\Shared\IntervalProvider;
use PHPUnit\Framework\TestCase;

final class CreateFizzBuzzTest extends TestCase
{
    /**
     * @dataProvider \App\Tests\Shared\IntervalProvider::rightValues
     */
    public function testCreateFizzBuzz($init, $end, $expected): void
    {
        $fizzBuzz = FizzBuzz::create($init, $end);
        $this->assertSame($expected, (string)$fizzBuzz);
    }
}
