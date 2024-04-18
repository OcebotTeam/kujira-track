<?php

namespace Ocebot\KujiraTrack\App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ocebot\KujiraTrack\App\Entity\LockedManta;

/**
 * @extends ServiceEntityRepository<LockedManta>
 *
 * @method LockedManta|null find($id, $lockMode = null, $lockVersion = null)
 * @method LockedManta|null findOneBy(array $criteria, array $orderBy = null)
 * @method LockedManta[]    findAll()
 * @method LockedManta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LockedMantaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LockedManta::class);
    }

    public function save(LockedManta $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LockedManta $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return LockedManta[] Returns an array of LockedManta objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?LockedManta
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
