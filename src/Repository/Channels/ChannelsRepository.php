<?php

namespace App\Repository\Channels;

use App\Entity\Channels\Channels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Channels|null find($id, $lockMode = null, $lockVersion = null)
 * @method Channels|null findOneBy(array $criteria, array $orderBy = null)
 * @method Channels[]    findAll()
 * @method Channels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChannelsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Channels::class);
    }

    // /**
    //  * @return Channels[] Returns an array of Channels objects
    //  */
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
    public function findOneBySomeField($value): ?Channels
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
