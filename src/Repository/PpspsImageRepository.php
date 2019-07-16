<?php

namespace App\Repository;

use App\Entity\PpspsImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PpspsImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PpspsImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PpspsImage[]    findAll()
 * @method PpspsImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PpspsImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PpspsImage::class);
    }

    // /**
    //  * @return PpspsImage[] Returns an array of PpspsImage objects
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
    public function findOneBySomeField($value): ?PpspsImage
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
