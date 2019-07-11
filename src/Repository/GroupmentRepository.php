<?php

namespace App\Repository;

use App\Entity\Groupment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Groupment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Groupment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Groupment[]    findAll()
 * @method Groupment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Groupment::class);
    }

    // /**
    //  * @return Groupment[] Returns an array of Groupment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Group
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
