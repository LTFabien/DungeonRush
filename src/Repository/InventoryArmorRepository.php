<?php

namespace App\Repository;

use App\Entity\InventoryArmor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InventoryArmor|null find($id, $lockMode = null, $lockVersion = null)
 * @method InventoryArmor|null findOneBy(array $criteria, array $orderBy = null)
 * @method InventoryArmor[]    findAll()
 * @method InventoryArmor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventoryArmorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InventoryArmor::class);
    }

    // /**
    //  * @return InventoryArmor[] Returns an array of InventoryArmor objects
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
    public function findOneBySomeField($value): ?InventoryArmor
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
