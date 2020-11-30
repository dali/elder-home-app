<?php

namespace App\Repository;

use App\Entity\Family;
use App\Entity\User;
use App\Entity\Resident;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Pagination\Paginator;

/**
 * @method Family|null find($id, $lockMode = null, $lockVersion = null)
 * @method Family|null findOneBy(array $criteria, array $orderBy = null)
 * @method Family[]    findAll()
 * @method Family[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FamilyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Family::class);
    }

    // /**
    //  * @return Family[] Returns an array of Family objects
    //  */
    
    public function findFamilies()
    {
        return $this->createQueryBuilder('f')
            ->innerJoin('f.user', 'u')
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findFamilyUsers()
    {
        return $this->createQueryBuilder('f')
            ->addSelect('u', 'r')
            ->leftJoin('f.user', 'u')
            ->leftJoin('f.residents', 'r')
            ->orderBy('f.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;

       
    }
    /*
    public function findOneBySomeField($value): ?Family
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
