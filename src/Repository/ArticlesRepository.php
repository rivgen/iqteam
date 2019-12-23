<?php

namespace App\Repository;

use App\Entity\Articles;
use App\Entity\ArticlesCategory;
use App\Entity\ButtonArticles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Articles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Articles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Articles[]    findAll()
 * @method Articles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Articles::class);
    }

    /**
     * @return Articles[] Returns an array of Qwerty objects
     */

    public function articlesInCategory()
    {
        $qb = $this->createQueryBuilder('a')->select('a.id, a.img, a.title, a.textPreview, ac.id category');
        $qb->leftJoin(ArticlesCategory::class, 'ac', 'WITH', 'a.category = ac.id');

        return $qb->getQuery()->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Qwerty
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
