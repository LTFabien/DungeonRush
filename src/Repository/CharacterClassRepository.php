<?php

namespace App\Repository;

use App\Entity\CharacterClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CharacterClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterClass[]    findAll()
 * @method CharacterClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterClassRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CharacterClass::class);
    }

    // /**
    //  * @return CharacterClass[] Returns an array of CharacterClass objects
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
    public function findOneBySomeField($value): ?CharacterClass
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
