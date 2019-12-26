<?php

namespace App\Repository;

use App\Entity\ImgArticles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ImgArticles|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImgArticles|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImgArticles[]    findAll()
 * @method ImgArticles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImgArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImgArticles::class);
    }

    // /**
    //  * @return ImgArticles[] Returns an array of ImgArticles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImgArticles
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
