<?php

namespace App\Repository\Compras;

use App\Entity\Compras\detallecompra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<detallecompra>
 *
 * @method detallecompra|null find($id, $lockMode = null, $lockVersion = null)
 * @method detallecompra|null findOneBy(array $criteria, array $orderBy = null)
 * @method detallecompra[]    findAll()
 * @method detallecompra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class detallecompraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, detallecompra::class);
    }

//    /**
//     * @return detallecompra[] Returns an array of detallecompra objects
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

//    public function findOneBySomeField($value): ?detallecompra
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
