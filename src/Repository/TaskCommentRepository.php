<?php

namespace App\Repository;

use App\Entity\TaskComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TaskComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskComment[]    findAll()
 * @method TaskComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskComment::class);
    }

    // /**
    //  * @return TaskComment[] Returns an array of TaskComment objects
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
    public function findOneBySomeField($value): ?TaskComment
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
