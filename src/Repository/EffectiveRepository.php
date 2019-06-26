<?php

namespace App\Repository;

use App\Entity\Effective;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Effective|null find($id, $lockMode = null, $lockVersion = null)
 * @method Effective|null findOneBy(array $criteria, array $orderBy = null)
 * @method Effective[]    findAll()
 * @method Effective[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EffectiveRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Effective::class);
    }

    // /**
    //  * @return Effective[] Returns an array of Effective objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Effective
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
