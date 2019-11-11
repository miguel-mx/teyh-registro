<?php

namespace App\Repository;

use App\Entity\Recomendacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Recomendacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recomendacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recomendacion[]    findAll()
 * @method Recomendacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecomendacionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recomendacion::class);
    }

    // /**
    //  * @return Recomendacion[] Returns an array of Recomendacion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recomendacion
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
