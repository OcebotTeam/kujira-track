<?php

namespace Ocebot\KujiraTrack\Staking\Infrastructure;

use App\Entity\StakedTokens;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\Staking\Domain\StakedKuji;
use Ocebot\KujiraTrack\Staking\Domain\StakedKujiCollection;
use Ocebot\KujiraTrack\Staking\Domain\StakedKujiRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class StakedKujiRepositoryDoctrine implements StakedKujiRepository
{
    public function __construct(
      private readonly EntityManagerInterface $entityManager,
      private readonly CacheInterface $cache
    ) {
    }

    /**
     * Get all staked kuji from the database
     * but only keeping last value for each day.
     */
    public function get(): StakedKujiCollection
    {
      return $this->cache->get('stakedKuji', function (ItemInterface $item) {
        $item->expiresAfter(3600); // 1h cache

        $entityRepository = $this->entityManager->getRepository(StakedTokens::class);
        $entities = $entityRepository->findBy([], ["tracked" => "ASC"]);

        $stakedKuji = [];

        foreach ($entities as $entity) {
            $time = $entity->getTracked()->format('Y-m-d');
            $stakedKuji[$time] = new StakedKuji(
                $time,
                $entity->getBondedTokens(),
                $entity->getNotBondedTokens()
            );
        }

        $stakedKuji = array_values($stakedKuji);

        return new StakedKujiCollection($stakedKuji);
      });
    }

    public function store(StakedKuji $stakedKuji): void
    {
        $entity = new StakedTokens();
        $entity->setTracked(new DateTime($stakedKuji->time()));
        $entity->setBondedTokens($stakedKuji->bondedTokens());
        $entity->setNotBondedTokens($stakedKuji->notBondedTokens());

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}