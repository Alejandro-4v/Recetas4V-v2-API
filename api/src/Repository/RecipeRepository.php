<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Recipe::class);
    }

    /**
     * @return Recipe[] Returns an array of Recipe objects
     */
    public function findByType(int $typeID): array {
        return $this->createQueryBuilder('r')
            ->andWhere('r.type = :val')
            ->setParameter('val', $typeID)
            ->orderBy('r.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function delete(Recipe $recipe): void {
        $this->getEntityManager()->remove($recipe);
        $this->getEntityManager()->flush();
    }

    public function update(Recipe $recipe): void {
        $this->getEntityManager()->persist($recipe);
        $this->getEntityManager()->flush();
    }

}
