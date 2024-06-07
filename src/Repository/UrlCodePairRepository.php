<?php

namespace App\Repository;

use App\Entity\UrlCodePairEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UrlCodePairEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method UrlCodePairEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method UrlCodePairEntity[] findAll()
 * @method UrlCodePairEntity[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class UrlCodePairRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UrlCodePairEntity::class);
    }

    //    /**
    //     * @return UrlCodePairQ[] Returns an array of UrlCodePairQ objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UrlCodePairQ
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
