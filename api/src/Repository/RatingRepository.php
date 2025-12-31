<?php

namespace App\Repository;

use App\Entity\Rating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rating>
 */
class RatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rating::class);
    }

    public function findByRecipeId(int $recipeId) {
        return $this->createQueryBuilder('r')
            ->andWhere('r.recipe = :val')
            ->setParameter('val', $recipeId)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
