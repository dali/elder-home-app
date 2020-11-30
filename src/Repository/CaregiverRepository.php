<?php

namespace App\Repository;

use App\Entity\Caregiver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\AST\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Caregiver|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caregiver|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caregiver[]    findAll()
 * @method Caregiver[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaregiverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caregiver::class);
    }

    /**
     * @return Caregiver[] Returns an array of Caregiver objects
     */
    
    public function findCaregivers()
    {
        return $this->createQueryBuilder('c')
            ->addSelect('u')
            ->leftJoin('c.user', 'u')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Caregiver
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
