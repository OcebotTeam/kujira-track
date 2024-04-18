<?php

namespace Ocebot\KujiraTrack\Mint\Infrastructure;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Ocebot\KujiraTrack\App\Entity\UskMinted;
use Ocebot\KujiraTrack\Mint\Domain\MintValue;
use Ocebot\KujiraTrack\Mint\Domain\MintValueCollection;
use Ocebot\KujiraTrack\Mint\Domain\MintValueRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class MintValueRepositoryDoctrine implements MintValueRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly CacheInterface $cache
    ) {
    }

    public function getAll(): MintValueCollection
    {
        return $this->cache->get('MintValues', function (ItemInterface $item) {
            $item->expiresAfter(3600); // 1h cache

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
                $UskMinted[$date] = new MintValue(
                    $sum,
                    $date
                );
            }


            return new MintValueCollection($UskMinted);
        });
    }

    public function getByCollateral(string $collateral): MintValueCollection
    {
        return $this->cache->get('mintValues' . $collateral, function (ItemInterface $item) use ($collateral) {
            $item->expiresAfter(3600); // 1h cache

            $entityRepository = $this->entityManager->getRepository(UskMinted::class);
            $entities = $entityRepository->findBy(['collateral' => $collateral], ['tracked' => 'ASC']);

            $UskMinted = [];

            foreach ($entities as $entity) {
                $date = $entity->getTracked()->format('Y-m-d');
                $UskMinted[$date] = new MintValue(
                    $entity->getNum(),
                    $date
                );
            }

            return new MintValueCollection($UskMinted);
        });
    }

    public function store(string $collateral, MintValue $mintValue): void
    {
        // Get last record
        $entityRepository = $this->entityManager->getRepository(UskMinted::class);
        $lastEntity = $entityRepository->findOneBy(["collateral" => $collateral], ["tracked" => "DESC"]);
        $currentDateTime = new DateTime();

        // If tracked of the last record date is from current day then skip
        if ($lastEntity && $lastEntity->getTracked()->format('Y-m-d') === $currentDateTime->format('Y-m-d')) {
            return;
        }

        $trackDate = new DateTime();
        $trackDate->setTimestamp($mintValue->time());

        $entity = new UskMinted();
        $entity->setTracked($trackDate);
        $entity->setCollateral($collateral);
        $entity->setNum($mintValue->amount());

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
