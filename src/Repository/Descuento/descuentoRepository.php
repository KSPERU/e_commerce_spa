<?php

namespace App\Repository\Descuento;

use App\Entity\Descuento\descuento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<descuento>
 *
 * @method descuento|null find($id, $lockMode = null, $lockVersion = null)
 * @method descuento|null findOneBy(array $criteria, array $orderBy = null)
 * @method descuento[]    findAll()
 * @method descuento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class descuentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, descuento::class);
    }

//    /**
//     * @return descuento[] Returns an array of descuento objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?descuento
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
