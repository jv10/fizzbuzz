<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\FizzBuzz;
use App\Repository\FizzBuzzRepository;

final class FizzBuzzGenerator
{
    public function __construct(private FizzBuzzRepository $repository)
    {

    }

    public function __invoke(int $ini, int $end): string
    {
        return $this->getFizzBuzzFromCache($ini, $end)
            ?? $this->generateFizzBuzz($ini, $end);
    }


    private function generateFizzBuzz($ini, $end): string
    {
        $fizzBuzz = FizzBuzz::create($ini, $end);
        $this->cached($fizzBuzz);

        return (string) $fizzBuzz;
    }

    private function cached(FizzBuzz $fizzBuzz): void
    {
        $this->repository->save($fizzBuzz);
    }

    private function getFizzBuzzFromCache(int $ini, int $end): string | null
    {
        return $this->repository->search($ini, $end)?->getValue();
    }
}
