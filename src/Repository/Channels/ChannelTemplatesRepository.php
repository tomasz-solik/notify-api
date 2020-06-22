<?php

namespace App\Repository\Channels;

use App\Entity\Channels\ChannelTemplates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChannelTemplates|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChannelTemplates|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChannelTemplates[]    findAll()
 * @method ChannelTemplates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChannelTemplatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChannelTemplates::class);
    }

    // /**
    //  * @return ChannelTemplates[] Returns an array of ChannelTemplates objects
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
    public function findOneBySomeField($value): ?ChannelTemplates
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
