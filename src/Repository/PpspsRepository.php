<?php

namespace App\Repository;

use App\Entity\Ppsps;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ppsps|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ppsps|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ppsps[]    findAll()
 * @method Ppsps[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PpspsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ppsps::class);
    }

    // /**
    //  * @return Ppsps[] Returns an array of Ppsps objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ppsps
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
