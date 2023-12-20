<?php

namespace App\Repository;

use App\Entity\Liquidations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Liquidations>
 *
 * @method Liquidations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Liquidations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Liquidations[]    findAll()
 * @method Liquidations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LiquidationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Liquidations::class);
    }

    public function save(Liquidations $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Liquidations $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Liquidations[] Returns an array of Liquidations objects
//     */
    public function findByLiquidationID($value): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.liquidation_id = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Liquidations
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
