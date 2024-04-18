<?php

namespace Ocebot\KujiraTrack\App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ocebot\KujiraTrack\App\Entity\GhostDeposit;

/**
 * @extends ServiceEntityRepository<GhostDeposit>
 *
 * @method GhostDeposit|null find($id, $lockMode = null, $lockVersion = null)
 * @method GhostDeposit|null findOneBy(array $criteria, array $orderBy = null)
 * @method GhostDeposit[]    findAll()
 * @method GhostDeposit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GhostDepositRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GhostDeposit::class);
    }

    public function save(GhostDeposit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GhostDeposit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return GhostDeposit[] Returns an array of GhostDeposit objects
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

    //    public function findOneBySomeField($value): ?GhostDeposit
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
