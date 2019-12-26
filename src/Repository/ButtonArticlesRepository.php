<?php

namespace App\Repository;

use App\Entity\Articles;
use App\Entity\Button;
use App\Entity\ButtonArticles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ButtonArticles|null find($id, $lockMode = null, $lockVersion = null)
 * @method ButtonArticles|null findOneBy(array $criteria, array $orderBy = null)
 * @method ButtonArticles[]    findAll()
 * @method ButtonArticles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ButtonArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ButtonArticles::class);
    }

    public function buttonInArticle()
    {
        $qb = $this->createQueryBuilder('bu')->select('bu.url, a.id, b.title, b.icon');
        $qb->leftJoin(Articles::class, 'a', 'WITH', 'bu.articles = a.id');
        $qb->leftJoin(Button::class, 'b', 'WITH', 'bu.button = b.id');
        return $qb->getQuery()->getResult();
    }

    public function findButton($id)
    {
        $qb = $this->createQueryBuilder('bu')->select('bu.url, a.id, b.title, b.icon');
        $qb->leftJoin(Articles::class, 'a', 'WITH', 'bu.articles = a.id');
        $qb->leftJoin(Button::class, 'b', 'WITH', 'bu.button = b.id');
        $qb->andWhere('a.id = :id');
        $qb->setParameter('id', $id);

        return $qb->getQuery()->getResult();
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
