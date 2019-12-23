<?php

namespace App\Repository;

use App\Entity\ArticlesCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ArticlesCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticlesCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticlesCategory[]    findAll()
 * @method ArticlesCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticlesCategory::class);
    }

    public function allCategory()
    {
        $qb = $this->createQueryBuilder('c')->select('c.id, c.title');

        return $qb->getQuery()->getResult();
    }

}
