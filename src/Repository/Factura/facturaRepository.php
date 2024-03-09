<?php

namespace App\Repository\Factura;

use App\Entity\Factura\factura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<factura>
 *
 * @method factura|null find($id, $lockMode = null, $lockVersion = null)
 * @method factura|null findOneBy(array $criteria, array $orderBy = null)
 * @method factura[]    findAll()
 * @method factura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class facturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, factura::class);
    }

    //    /**
    //     * @return factura[] Returns an array of factura objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?factura
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
