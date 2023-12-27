<?php

namespace App\Repository\Carrito;

use App\Entity\Carrito\carrito;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<carrito>
 *
 * @method carrito|null find($id, $lockMode = null, $lockVersion = null)
 * @method carrito|null findOneBy(array $criteria, array $orderBy = null)
 * @method carrito[]    findAll()
 * @method carrito[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class carritoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, carrito::class);
    }

//    /**
//     * @return carrito[] Returns an array of carrito objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?carrito
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
