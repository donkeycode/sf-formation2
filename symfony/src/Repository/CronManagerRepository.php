<?php

namespace App\Repository;

use App\Entity\CronManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CronManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method CronManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method CronManager[]    findAll()
 * @method CronManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CronManagerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CronManager::class);
    }

//    /**
//     * @return CronManager[] Returns an array of CronManager objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CronManager
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
