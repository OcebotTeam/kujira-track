<?php

namespace Ocebot\KujiraTrack\Wallets\Infrastructure;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\Wallets\Domain\Wallets;
use Ocebot\KujiraTrack\Wallets\Domain\WalletsCollection;
use Ocebot\KujiraTrack\Wallets\Domain\WalletsRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class WalletsRepositoryDoctrine implements WalletsRepository
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
    public function get(): WalletsCollection
    {
        return $this->cache->get('wallets', function (ItemInterface $item) {
            $item->expiresAfter(3600); // 1h cache

            $entityRepository = $this->entityManager->getRepository(\Ocebot\KujiraTrack\App\Entity\Wallets::class);
            $entities = $entityRepository->findBy([], ["tracked" => "ASC"]);

            $wallets = [];

            foreach ($entities as $entity) {
                $time = $entity->getTracked()->format('Y-m-d');
                $wallets[$time] = new Wallets(
                    $time,
                    $entity->getNum(),
                );
            }

            $wallets = array_values($wallets);

            return new WalletsCollection($wallets);
        });
    }

    public function store(Wallets $wallets): void
    {
        $trackDate = new DateTime();
        $trackDate->setTimestamp($wallets->time());

        $entity = new \Ocebot\KujiraTrack\App\Entity\Wallets();
        $entity->setTracked($trackDate);
        $entity->setNum($wallets->amount());

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
