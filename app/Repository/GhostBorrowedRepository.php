<?php

namespace Ocebot\KujiraTrack\App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ocebot\KujiraTrack\App\Entity\GhostBorrowed;

/**
 * @extends ServiceEntityRepository<GhostBorrowed>
 *
 * @method GhostBorrowed|null find($id, $lockMode = null, $lockVersion = null)
 * @method GhostBorrowed|null findOneBy(array $criteria, array $orderBy = null)
 * @method GhostBorrowed[]    findAll()
 * @method GhostBorrowed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GhostBorrowedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GhostBorrowed::class);
    }

    public function save(GhostBorrowed $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GhostBorrowed $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return GhostBorrowed[] Returns an array of GhostBorrowed objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?GhostBorrowed
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
