<?php

namespace App\Repository;

use App\Entity\Move;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Move|null find($id, $lockMode = null, $lockVersion = null)
 * @method Move|null findOneBy(array $criteria, array $orderBy = null)
 * @method Move[]    findAll()
 * @method Move[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoveRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Move::class);
    }

    /**
      * @return Move[] Returns an array of Move objects
     */

    public function findByLevel($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.lvl >= :lvl')
            ->setParameter('lvl', $value)
            ->orderBy('l.lvl', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Move
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
