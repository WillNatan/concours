<?php

namespace App\Repository;

use App\Entity\FormContest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FormContest|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormContest|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormContest[]    findAll()
 * @method FormContest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormContestRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FormContest::class);
    }

    // /**
    //  * @return FormContest[] Returns an array of FormContest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormContest
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
