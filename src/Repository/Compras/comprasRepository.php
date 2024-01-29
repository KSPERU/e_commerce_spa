<?php

namespace App\Repository\Compras;

use App\Entity\Compras\compras;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<compras>
 *
 * @method compras|null find($id, $lockMode = null, $lockVersion = null)
 * @method compras|null findOneBy(array $criteria, array $orderBy = null)
 * @method compras[]    findAll()
 * @method compras[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class comprasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, compras::class);
    }

//    /**
//     * @return compras[] Returns an array of compras objects
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

//    public function findOneBySomeField($value): ?compras
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
