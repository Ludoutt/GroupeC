<?php

namespace App\Repository;

use App\Entity\TaskTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TaskTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskTag[]    findAll()
 * @method TaskTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskTag::class);
    }

    // /**
    //  * @return TaskTag[] Returns an array of TaskTag objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TaskTag
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
