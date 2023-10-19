<?php

namespace App\Repository;

use App\Entity\WeatherType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WeatherType>
 *
 * @method WeatherType|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherType|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherType[]    findAll()
 * @method WeatherType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeatherType::class);
    }

//    /**
//     * @return WeatherType[] Returns an array of WeatherType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WeatherType
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
