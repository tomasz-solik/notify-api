<?php

namespace App\Repository\Channels;

use App\Entity\Channels\ChannelsUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChannelsUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChannelsUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChannelsUsers[]    findAll()
 * @method ChannelsUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChannelsUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChannelsUsers::class);
    }

    // /**
    //  * @return ChannelsUsers[] Returns an array of ChannelsUsers objects
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
    public function findOneBySomeField($value): ?ChannelsUsers
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
