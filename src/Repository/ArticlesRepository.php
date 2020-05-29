<?php

namespace App\Repository;

use App\Entity\Articles;
use App\Entity\ArticlesCategory;
use App\Entity\Button;
use App\Entity\ButtonArticles;
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

    protected function img()
    {
        return $this->createQueryBuilder('i')
            ->select('ia.img')
            ->leftJoin(ImgArticles::class, 'ia', 'WITH', 'ia.article = i.id')
//            ->andWhere('i.id = :id')
//            ->setParameter('id', $id)
            ->getQuery()->getResult();
    }

    public function articlesInCategory()
    {

        $qb = $this->createQueryBuilder('a')->select('a.id, a.alias, a.title, a.titleEn, a.textPreview, a.textPreviewEn, ac.id category, a.icon');
        $qb->leftJoin(ArticlesCategory::class, 'ac', 'WITH', 'a.category = ac.id');
        $qb->orderBy('a.ordering', 'ASC');

        return $qb->getQuery()->getResult();
    }

    public function findArticle($id)
    {
        $qb = $this->createQueryBuilder('a')->select('a.id, a.title, a.titleEn, a.alias, a.textPreview, a.textPreviewEn, ac.id category, a.icon, a.fullTitle, a.fullTitleEn, a.technology, a.technologyEn, a.client, a.clientEn, a.year, a.description, a.descriptionEn, a.metaTitle, a.metaTitleEn, a.metaDescription, a.metaDescriptionEn');
        $qb->leftJoin(ArticlesCategory::class, 'ac', 'WITH', 'a.category = ac.id');
        $qb->andWhere('a.id = :id');
        $qb->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findArticleId($alias)
    {
        $qb = $this->createQueryBuilder('a')->select('a.id');
        $qb->andWhere('a.alias = :alias');
        $qb->setParameter('alias', $alias);

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findArticleEdit($id)
    {
        $qb = $this->createQueryBuilder('a')->select('b.title buttonTitle, b.icon buttonIcon, ba.url, img.general, img.img, a.id, a.title, a.textPreview, ac.id category, a.icon, a.fullTitle, a.technology, a.client, a.year, a.description, a.alias, a.author');
        $qb->leftJoin(ArticlesCategory::class, 'ac', 'WITH', 'a.category = ac.id');
        $qb->leftJoin(ImgArticles::class, 'img', 'WITH', 'img.article = a.id');
        $qb->leftJoin(ButtonArticles::class, 'ba', 'WITH', 'ba.articles = a.id');
        $qb->leftJoin(Button::class, 'b', 'WITH', 'b.id = ba.button');
        $qb->andWhere('a.id = :id');
        $qb->setParameter('id', $id);

        return $qb->getQuery()->getResult();
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

    public function endId()
    {
        $qb = $this->createQueryBuilder('a')->select('MAX(a.id)');

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function startId()
    {
        $qb = $this->createQueryBuilder('a')->select('MIN(a.id)');

        return $qb->getQuery()->getSingleScalarResult();
    }

}
