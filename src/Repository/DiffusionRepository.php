<?php

namespace App\Repository;

use App\Entity\Diffusion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Diffusion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Diffusion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Diffusion[]    findAll()
 * @method Diffusion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiffusionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Diffusion::class);
    }

    // /**
    //  * @return Diffusion[] Returns an array of Diffusion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Diffusion
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
