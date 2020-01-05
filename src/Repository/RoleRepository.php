<?php

namespace App\Repository;

use App\Entity\Role;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Role|null find($id, $lockMode = null, $lockVersion = null)
 * @method Role|null findOneBy(array $criteria, array $orderBy = null)
 * @method Role[]    findAll()
 * @method Role[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Role::class);
    }

    public function getNameRole($admin)
    {
        $qb = $this->createQueryBuilder('r')->select('r.nameRole');
        $qb -> andWhere('r.nameRole != :admin');
        $qb-> setParameter('admin', $admin);
        $roles = $qb->getQuery()->getArrayResult();
        $out = [];
        foreach ($roles as $role) {
            $out[$role['nameRole']] = $role['nameRole'];
        }

        return $out;
    }
}
