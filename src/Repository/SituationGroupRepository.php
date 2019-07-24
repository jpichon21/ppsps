<?php

namespace App\Repository;

use App\Entity\SituationGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SituationGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method SituationGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method SituationGroup[]    findAll()
 * @method SituationGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SituationGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SituationGroup::class);
    }

    // /**
    //  * @return SituationGroup[] Returns an array of SituationGroup objects
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
    public function findOneBySomeField($value): ?SituationGroup
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
