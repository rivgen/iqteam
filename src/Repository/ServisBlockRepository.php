<?php

namespace App\Repository;

use App\Entity\ServisBlok;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ServisBlock|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServisBlock|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServisBlock[]    findAll()
 * @method ServisBlock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServisBlockRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServisBlok::class);
    }

//    public function all()
//    {
//        $qb = $this->createQueryBuilder('hb')->select('hb.id, hb.titleRu, hbt.title, hbt.text, hbt.icon, hbt.checkmark, hbt.language');
//        $qb->leftJoin(HomeBlockText::class, 'hbt', 'WITH', 'hbt.block = hb.id');
////        $qb->andWhere('hb.id = :id');
////        $qb->setParameter('id', $id);
////        $qb->andWhere('hbt.checkmark = :chec');
////        $qb->setParameter('chec', $chec);
//
//        return $qb->getQuery()->getResult();
//    }
//
//    public function allBlock()
//    {
//        $qb = $this->createQueryBuilder('hb')->select('hb.id, hb.titleRu, hb.titleEn');
//
//        return $qb->getQuery()->getResult();
//    }

}