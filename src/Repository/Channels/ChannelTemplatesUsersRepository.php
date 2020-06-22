<?php

namespace App\Repository\Channels;

use App\Entity\Channels\ChannelTemplatesUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChannelTemplatesUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChannelTemplatesUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChannelTemplatesUsers[]    findAll()
 * @method ChannelTemplatesUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChannelTemplatesUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChannelTemplatesUsers::class);
    }

    // /**
    //  * @return ChannelTemplatesUsers[] Returns an array of ChannelTemplatesUsers objects
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
    public function findOneBySomeField($value): ?ChannelTemplatesUsers
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
