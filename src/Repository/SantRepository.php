<?php

namespace App\Repository;

use App\Entity\Sant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sant[]    findAll()
 * @method Sant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sant::class);
    }

    public function findNumberOfSants()
    {
        return $this->createQueryBuilder('s')
            ->select('COUNT(s)')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Sant[] Returns an array of Sant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sant
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
