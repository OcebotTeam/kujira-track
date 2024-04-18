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
    private const PRECISION = 1000000;
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
                    $entity->getBondedTokens()  / self::PRECISION,
                    $entity->getNotBondedTokens()
                );
            }

            $stakedKuji = array_values($stakedKuji);

            return new StakedKujiCollection($stakedKuji);
        });
    }

    /**
     * Store Current taked kuji in the database
     * but only keeping last value for each day
     */
    public function store(StakedKuji $stakedKuji): void
    {
        // Get last record
        $entityRepository = $this->entityManager->getRepository(StakedTokens::class);
        $lastEntity = $entityRepository->findOneBy([], ["tracked" => "DESC"]);
        $currentDateTime = new DateTime();

        // If tracked of the last record date is from current day then skip
        if ($lastEntity && $lastEntity->getTracked()->format('Y-m-d') === $currentDateTime->format('Y-m-d')) {
            return;
        }

        $trackDate = new DateTime();
        $trackDate->setTimestamp($stakedKuji->time());

        $entity = new StakedTokens();
        $entity->setTracked($trackDate);
        $entity->setBondedTokens($stakedKuji->bondedTokens());
        $entity->setNotBondedTokens($stakedKuji->notBondedTokens());

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
