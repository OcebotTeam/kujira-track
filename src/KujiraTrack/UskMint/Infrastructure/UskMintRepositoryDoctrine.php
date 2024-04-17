<?php

namespace Ocebot\KujiraTrack\UskMint\Infrastructure;

use App\Entity\UskMinted;
use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\UskMint\Domain\UskMint;
use Ocebot\KujiraTrack\UskMint\Domain\UskMintCollection;
use Ocebot\KujiraTrack\UskMint\Domain\UskMintRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;


class UskMintRepositoryDoctrine implements UskMintRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly CacheInterface $cache
    ) {
    }

    public function getAll(): UskMintCollection
    {
        //return $this->cache->get('UskMint', function (ItemInterface $item) {
            //$item->expiresAfter(3600); // 1h cache

            $entityRepository = $this->entityManager->getRepository(UskMinted::class);
            $entities = $entityRepository->findBy([], ['tracked' => 'ASC']);

            $UskMinted = [];

            foreach ($entities as $entity) {
                $date = $entity->getTracked()->format('Y-m-d');
                $UskMinted[$date][$entity->getCollateral()] = [
                    $entity->getNum(),
                    $date
                ];
            }

            // We sum the values per each day from UskMinted array
            foreach ($UskMinted as $date => $collateral) {
                $sum = 0;
                foreach ($collateral as $value) {
                    $sum += $value[0];
                }
                $UskMinted[$date] = new UskMint(
                    $sum,
                    $date
                );
            }


            return new UskMintCollection($UskMinted);
        //});
    }

    public function getByCollateral(string $collateral): UskMintCollection
    {
        return $this->cache->get('UskMintCollateral', function (ItemInterface $item) use  ($collateral) {
            $item->expiresAfter(3600); // 1h cache

            $entityRepository = $this->entityManager->getRepository(UskMinted::class);
            $entities = $entityRepository->findBy(['collateral' => $collateral], ['tracked' => 'ASC']);

            $UskMinted = [];

            foreach ($entities as $entity) {
                $date = $entity->getTracked()->format('Y-m-d');
                $UskMinted[$date] = new UskMint(
                    $entity->getNum(),
                    $date
                );
            }

            return new UskMintCollection($UskMinted);
        });
    }
}
