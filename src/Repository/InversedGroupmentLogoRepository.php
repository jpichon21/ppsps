<?php

namespace App\Repository;

use App\Entity\InversedGroupmentLogo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InversedGroupmentLogo|null find($id, $lockMode = null, $lockVersion = null)
 * @method InversedGroupmentLogo|null findOneBy(array $criteria, array $orderBy = null)
 * @method InversedGroupmentLogo[]    findAll()
 * @method InversedGroupmentLogo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InversedGroupmentLogoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InversedGroupmentLogo::class);
    }

    // /**
    //  * @return InversedGroupmentLogo[] Returns an array of InversedGroupmentLogo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InversedGroupmentLogo
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
