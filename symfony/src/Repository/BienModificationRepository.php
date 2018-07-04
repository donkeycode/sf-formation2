<?php

namespace App\Repository;

use App\Entity\BienModification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BienModification|null find($id, $lockMode = null, $lockVersion = null)
 * @method BienModification|null findOneBy(array $criteria, array $orderBy = null)
 * @method BienModification[]    findAll()
 * @method BienModification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienModificationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BienModification::class);
    }
    

//    /**
//     * @return BienModification[] Returns an array of BienModification objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BienModification
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
