<?php

namespace App\Repository;

use App\Entity\InventoryWeapons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InventoryWeapons|null find($id, $lockMode = null, $lockVersion = null)
 * @method InventoryWeapons|null findOneBy(array $criteria, array $orderBy = null)
 * @method InventoryWeapons[]    findAll()
 * @method InventoryWeapons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventoryWeaponsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InventoryWeapons::class);
    }

    // /**
    //  * @return InventoryWeapons[] Returns an array of InventoryWeapons objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InventoryWeapons
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
