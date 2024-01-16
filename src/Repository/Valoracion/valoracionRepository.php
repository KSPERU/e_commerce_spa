<?php

namespace App\Repository\Valoracion;

use App\Entity\Valoracion\valoracion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<valoracion>
 *
 * @method valoracion|null find($id, $lockMode = null, $lockVersion = null)
 * @method valoracion|null findOneBy(array $criteria, array $orderBy = null)
 * @method valoracion[]    findAll()
 * @method valoracion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class valoracionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, valoracion::class);
    }

//    /**
//     * @return valoracion[] Returns an array of valoracion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?valoracion
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
