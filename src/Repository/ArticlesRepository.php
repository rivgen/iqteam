<?php

namespace App\Repository;

use App\Entity\Articles;
use App\Entity\ArticlesCategory;
use App\Entity\ImgArticles;
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
        $qb = $this->createQueryBuilder('a')->select('a.id, ia.img, a.title, a.textPreview, ac.id category');
        $qb->leftJoin(ArticlesCategory::class, 'ac', 'WITH', 'a.category = ac.id');
        $qb->leftJoin(ImgArticles::class, 'ia', 'WITH', 'ia.article = a.id');
        $qb->andWhere('ia.general = :int');
        $qb->setParameter('int', 1);

        return $qb->getQuery()->getResult();
    }

    public function findArticle($id)
    {
        $qb = $this->createQueryBuilder('a')->select('a.id, ia.img, a.title, a.textPreview, ac.id category, a.icon, a.fullTitle, a.technology, a.client, a.year, a.description');
        $qb->leftJoin(ArticlesCategory::class, 'ac', 'WITH', 'a.category = ac.id');
        $qb->leftJoin(ImgArticles::class, 'ia', 'WITH', 'ia.article = a.id');
        $qb->andWhere('a.id = :id');
        $qb->setParameter('id', $id);
        $qb->andWhere('ia.general = :int');
        $qb->setParameter('int', 1);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function filterNextPrevious($id)
    {
        $expr = $this->_em->getExpressionBuilder();
        $qbNext = $this->createQueryBuilder('a')
            ->select(['MIN(a.id)'])
            ->where($expr->gt('a.id', ':id'));
        $qbPrevious = $this->createQueryBuilder('b')
            ->select(['MAX(b.id)'])
            ->where($expr->lt('b.id', ':id'));
        $query = $this->createQueryBuilder('m')
            ->select(['m.id'])
            ->where($expr->orX(
                $expr->eq('m.id', '(' . $qbNext->getDQL() . ')'),
                $expr->eq('m.id', '(' . $qbPrevious->getDQL() . ')')
            ))
            ->setParameter('id', $id)
            ->addOrderBy('m.id', 'ASC')
            ->getQuery();

        return $query->getScalarResult();
    }

    public function endId(){
        $qb = $this->createQueryBuilder('a')->select('MAX(a.id)');

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function startId(){
        $qb = $this->createQueryBuilder('a')->select('MIN(a.id)');

        return $qb->getQuery()->getSingleScalarResult();
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
