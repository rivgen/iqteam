<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class DocksRepository extends EntityRepository
{


    public function searchDocks($id, $local)
    {
        $qb = $this->createQueryBuilder('d')->select('d.en, d.ru');
        $qb->andWhere('d.id = :id');
        $qb->setParameter('id', $id);
        $results = $qb->getQuery()->getSingleResult();
        $name = '';
        foreach ($results as $key => $result) {
            if ($key == $local) {
                $name = $result;
            }
        }
        return $name;
//        return $qb->getQuery()->getResult();
    }

}