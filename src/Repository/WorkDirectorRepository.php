<?php

namespace App\Repository;

use App\Entity\WorkDirector;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorkDirector|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkDirector|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkDirector[]    findAll()
 * @method WorkDirector[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkDirectorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorkDirector::class);
    }

    // /**
    //  * @return WorkDirector[] Returns an array of WorkDirector objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkDirector
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
