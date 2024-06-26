<?php

namespace Ocebot\KujiraTrack\App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ocebot\KujiraTrack\App\Entity\Wallets;

/**
 * @extends ServiceEntityRepository<Wallets>
 *
 * @method Wallets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wallets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wallets[]    findAll()
 * @method Wallets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WalletsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wallets::class);
    }

    public function add(Wallets $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Wallets $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Wallets[] Returns an array of Wallets objects
     */
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

    public function findOneByDate($value): ?Wallets
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField like :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
