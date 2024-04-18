<?php

namespace Ocebot\KujiraTrack\App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ocebot\KujiraTrack\App\Entity\CommunityPool;

/**
 * @extends ServiceEntityRepository<CommunityPool>
 *
 * @method CommunityPool|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommunityPool|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommunityPool[]    findAll()
 * @method CommunityPool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommunityPoolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommunityPool::class);
    }

    public function add(CommunityPool $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CommunityPool $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return CommunityPool[] Returns an array of CommunityPool objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CommunityPool
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
