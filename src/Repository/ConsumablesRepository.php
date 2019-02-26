<?php

namespace App\Repository;

use App\Entity\Consumables;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Consumables|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consumables|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consumables[]    findAll()
 * @method Consumables[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsumablesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Consumables::class);
    }

    // /**
    //  * @return Consumables[] Returns an array of Consumables objects
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
    public function findOneBySomeField($value): ?Consumables
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
