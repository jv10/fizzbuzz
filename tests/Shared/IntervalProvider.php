<?php

declare(strict_types=1);

namespace App\Tests\Shared;

final class IntervalProvider
{
    public static function rightValues(): \Generator
    {
        yield 'set 1' => [
            30, 67, 'FizzBuzz, 31, 32, Fizz, 34, Buzz, Fizz, 37, 38, Fizz, Buzz, 41, Fizz, 43, 44, FizzBuzz, 46, 47, Fizz, 49, Buzz, Fizz, 52, 53, Fizz, Buzz, 56, Fizz, 58, 59, FizzBuzz, 61, 62, Fizz, 64, Buzz, Fizz, 67'
        ];
    }
}
