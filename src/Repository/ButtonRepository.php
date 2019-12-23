<?php

namespace App\Repository;

use App\Entity\Button;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Button|null find($id, $lockMode = null, $lockVersion = null)
 * @method Button|null findOneBy(array $criteria, array $orderBy = null)
 * @method Button[]    findAll()
 * @method Button[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ButtonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Button::class);
    }

    // /**
    //  * @return Batton[] Returns an array of Batton objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Batton
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
