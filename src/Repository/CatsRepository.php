<?php

namespace App\Repository;

use App\Entity\Cats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cats|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cats|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cats[]    findAll()
 * @method Cats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cats::class);
    }

    // /**
    //  * @return Cats[] Returns an array of Cats objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cats
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
