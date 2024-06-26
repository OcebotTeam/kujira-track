<?php

namespace Ocebot\KujiraTrack\App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ocebot\KujiraTrack\App\Entity\UskMinted;

/**
 * @extends ServiceEntityRepository<UskMinted>
 *
 * @method UskMinted|null find($id, $lockMode = null, $lockVersion = null)
 * @method UskMinted|null findOneBy(array $criteria, array $orderBy = null)
 * @method UskMinted[]    findAll()
 * @method UskMinted[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UskMintedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UskMinted::class);
    }

    public function add(UskMinted $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UskMinted $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByTrackedField($value): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.tracked like :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(40)
            ->getQuery()
            ->getResult()
        ;
    }
}
