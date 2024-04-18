<?php

namespace Ocebot\KujiraTrack\App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ocebot\KujiraTrack\App\Entity\StakedManta;

/**
 * @extends ServiceEntityRepository<StakedManta>
 *
 * @method StakedManta|null find($id, $lockMode = null, $lockVersion = null)
 * @method StakedManta|null findOneBy(array $criteria, array $orderBy = null)
 * @method StakedManta[]    findAll()
 * @method StakedManta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StakedMantaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StakedManta::class);
    }

    public function save(StakedManta $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(StakedManta $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return StakedManta[] Returns an array of StakedManta objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?StakedManta
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
