<?php

namespace App\Repository\Producto;

use App\Entity\Producto\producto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<producto>
 *
 * @method producto|null find($id, $lockMode = null, $lockVersion = null)
 * @method producto|null findOneBy(array $criteria, array $orderBy = null)
 * @method producto[]    findAll()
 * @method producto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class productoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, producto::class);
    }

//    /**
//     * @return producto[] Returns an array of producto objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?producto
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
