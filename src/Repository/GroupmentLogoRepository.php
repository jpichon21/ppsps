<?php

namespace App\Repository;

use App\Entity\GroupmentLogo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GroupmentLogo|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupmentLogo|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupmentLogo[]    findAll()
 * @method GroupmentLogo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupmentLogoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GroupmentLogo::class);
    }

    // /**
    //  * @return GroupmentLogo[] Returns an array of GroupmentLogo objects
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
    public function findOneBySomeField($value): ?GroupmentLogo
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
