<?php

namespace App\Repository\Channels;

use App\Entity\Channels\NewsReads;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NewsReads|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsReads|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsReads[]    findAll()
 * @method NewsReads[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsReadsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsReads::class);
    }

    // /**
    //  * @return NewsReads[] Returns an array of NewsReads objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewsReads
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
