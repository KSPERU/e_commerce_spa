<?php

namespace App\Repository\Factura;

use App\Entity\Factura\detallefactura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<detallefactura>
 *
 * @method detallefactura|null find($id, $lockMode = null, $lockVersion = null)
 * @method detallefactura|null findOneBy(array $criteria, array $orderBy = null)
 * @method detallefactura[]    findAll()
 * @method detallefactura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class detallefacturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, detallefactura::class);
    }

    //    /**
    //     * @return detallefactura[] Returns an array of detallefactura objects
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

    //    public function findOneBySomeField($value): ?detallefactura
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
