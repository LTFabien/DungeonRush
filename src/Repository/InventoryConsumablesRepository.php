<?php

namespace App\Repository;

use App\Entity\InventoryConsumables;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InventoryConsumables|null find($id, $lockMode = null, $lockVersion = null)
 * @method InventoryConsumables|null findOneBy(array $criteria, array $orderBy = null)
 * @method InventoryConsumables[]    findAll()
 * @method InventoryConsumables[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventoryConsumablesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InventoryConsumables::class);
    }

    // /**
    //  * @return InventoryConsumables[] Returns an array of InventoryConsumables objects
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
    public function findOneBySomeField($value): ?InventoryConsumables
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
