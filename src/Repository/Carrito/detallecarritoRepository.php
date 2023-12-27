<?php

namespace App\Repository\Carrito;

use App\Entity\Carrito\detallecarrito;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<detallecarrito>
 *
 * @method detallecarrito|null find($id, $lockMode = null, $lockVersion = null)
 * @method detallecarrito|null findOneBy(array $criteria, array $orderBy = null)
 * @method detallecarrito[]    findAll()
 * @method detallecarrito[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class detallecarritoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, detallecarrito::class);
    }

//    /**
//     * @return detallecarrito[] Returns an array of detallecarrito objects
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

//    public function findOneBySomeField($value): ?detallecarrito
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
