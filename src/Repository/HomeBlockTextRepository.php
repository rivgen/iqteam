<?php

namespace App\Repository;

use App\Entity\HomeBlock;
use App\Entity\HomeBlockText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HomeBlockText|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomeBlockText|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomeBlockText[]    findAll()
 * @method HomeBlockText[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomeBlockTextRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomeBlockText::class);
    }

    public function all($chec, $id)
    {
        $qb = $this->createQueryBuilder('hbt')->select('hbt.title, hbt.text, hbt.icon');
        $qb->leftJoin(HomeBlock::class, 'hb', 'WITH', 'hbt.block = hb.id');
        $qb->andWhere('hb.id = :id');
        $qb->setParameter('id', $id);
        $qb->andWhere('hbt.checkmark = :chec');
        $qb->setParameter('chec', $chec);

        return $qb->getQuery()->getResult();
    }

}