<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\FizzBuzz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class FizzBuzzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FizzBuzz::class);
    }

    public function search(int $init, int $end): FizzBuzz|null
    {
        return $this->createQueryBuilder('fb')
            ->andWhere('fb.id = :id')
            ->setParameter('id', FizzBuzz::calculeIdentifier($init, $end))
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function save(FizzBuzz $fizzBuzz): void
    {
        $this->getEntityManager()->persist($fizzBuzz);
        $this->getEntityManager()->flush();
    }
}
