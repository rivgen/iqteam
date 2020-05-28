<?php

namespace App\Repository;

use App\Entity\HomeBlock;
use App\Entity\HomeBlockText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HomeBlock|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomeBlock|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomeBlock[]    findAll()
 * @method HomeBlock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomeBlockRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomeBlock::class);
    }

    public function all()
    {
        $qb = $this->createQueryBuilder('hb')->select('hb.id, hb.titleRu, hb.titleEn, hbt.title, hbt.titleEn enTitle, hbt.text, hbt.textEn, hbt.icon, hbt.checkmark, hbt.language');
        $qb->leftJoin(HomeBlockText::class, 'hbt', 'WITH', 'hbt.block = hb.id');
//        $qb->andWhere('hb.id = :id');
//        $qb->setParameter('id', $id);
//        $qb->andWhere('hbt.checkmark = :chec');
//        $qb->setParameter('chec', $chec);

        return $qb->getQuery()->getResult();
    }

    public function allBlock()
    {
        $qb = $this->createQueryBuilder('hb')->select('hb.id, hb.titleRu, hb.titleEn');

        return $qb->getQuery()->getResult();
    }

}