<?php

namespace App\Repository;

use App\Entity\Randonnee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Randonnee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Randonnee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Randonnee[]    findAll()
 * @method Randonnee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RandonneeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Randonnee::class);
    }

    public function findMostRecent()
    {
        $date = Date("Y-m-d");
        return $this->createQueryBuilder('r')
            ->andWhere('r.date < :val')
            ->setParameter('val', $date)
            ->orderBy('r.date', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    public function countAll()
    {
        return $this->createQueryBuilder('r')
            ->select("COUNT(r) as number")
            ->getQuery()
            ->getResult();
    }

    public function findById($id): ?Randonnee
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findRandonneeByCategorie($id)
    {
        return $this->createQueryBuilder('r')
            ->join("r.categorie", "c")
            ->andWhere('c.id = :val')
            ->setParameter('val', $id)
            ->orderBy('r.titre', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Randonnee[] Returns an array of Randonnee objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Randonnee
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
