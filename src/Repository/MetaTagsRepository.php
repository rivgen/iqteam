<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class MetaTagsRepository extends EntityRepository
{


    public function metaTag($url)
    {

        $qb = $this->createQueryBuilder('mt')->select('mt.title, mt.description');
        $qb->andWhere('mt.url = :url');
        $qb->setParameter('url', $url);

        return $qb->getQuery()->getOneOrNullResult();
    }

}
