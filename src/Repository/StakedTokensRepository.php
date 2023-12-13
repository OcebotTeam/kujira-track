<?php

namespace App\Repository;

use App\Entity\StakedTokens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StakedTokens>
 *
 * @method StakedTokens|null find($id, $lockMode = null, $lockVersion = null)
 * @method StakedTokens|null findOneBy(array $criteria, array $orderBy = null)
 * @method StakedTokens[]    findAll()
 * @method StakedTokens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StakedTokensRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StakedTokens::class);
    }

    public function add(StakedTokens $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(StakedTokens $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByTrackedField($value): array
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.tracked like :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(40)
            ->getQuery()
            ->getResult()
        ;
    }

    //    /**
    //     * @return StakedTokens[] Returns an array of StakedTokens objects
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

    //    public function findOneBySomeField($value): ?StakedTokens
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
