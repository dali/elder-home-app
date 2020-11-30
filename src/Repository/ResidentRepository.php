<?php

namespace App\Repository;

use App\Entity\Resident;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Resident|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resident|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resident[]    findAll()
 * @method Resident[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResidentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resident::class);
    }

     /**
      * @return Resident[] Returns an array of Resident objects
      */
    
    public function findfamilies()
    {
        return $this->createQueryBuilder('r')
            ->select('r, u')
            ->from('App\Entity\User','u')
            ->where('r.family = u.id')
            ->getQuery()
            ->getResult()
        ;
    }



    public function findResidentsWithFamilies()
    {
        return $this->createQueryBuilder('r')
            ->addSelect('f','u')
            ->leftJoin('r.family', 'f')
            ->leftJoin('f.user', 'u')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Resident
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
