<?php

namespace App\Repository;

use App\Entity\Glycemia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Glycemia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Glycemia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Glycemia[]    findAll()
 * @method Glycemia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlycemiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Glycemia::class);
    }

    // /**
    //  * @return Glycemia[] Returns an array of Glycemia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Glycemia
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
