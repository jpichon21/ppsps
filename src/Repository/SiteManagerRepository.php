<?php

namespace App\Repository;

use App\Entity\SiteManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SiteManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiteManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiteManager[]    findAll()
 * @method SiteManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteManagerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SiteManager::class);
    }

    // /**
    //  * @return SiteManager[] Returns an array of SiteManager objects
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
    public function findOneBySomeField($value): ?SiteManager
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
