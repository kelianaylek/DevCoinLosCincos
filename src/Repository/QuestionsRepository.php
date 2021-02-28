<?php

namespace App\Repository;

use App\Entity\Questions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Questions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Questions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Questions[]    findAll()
 * @method Questions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Questions::class);
    }

    // /**
    //  * @return Questions[] Returns an array of Questions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Questions
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findUserQuestions($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.question_author = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findMostAnsweredQuestions()
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.question_answers', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByDate()
    {
        return $this->createQueryBuilder('q')
            ->orderBy('q.question_date', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findUnresolvedQuestions()
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.question_is_resolved = false')
            ->orderBy('q.question_date', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findResolvedQuestions()
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.question_is_resolved = true')
            ->orderBy('q.question_date', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}
