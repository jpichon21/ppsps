<?php

namespace App\Repository;

use App\Entity\SubcontractedWork;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SubcontractedWork|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubcontractedWork|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubcontractedWork[]    findAll()
 * @method SubcontractedWork[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubcontractedWorkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SubcontractedWork::class);
    }

    // /**
    //  * @return SubcontractedWork[] Returns an array of SubcontractedWork objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SubcontractedWork
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
