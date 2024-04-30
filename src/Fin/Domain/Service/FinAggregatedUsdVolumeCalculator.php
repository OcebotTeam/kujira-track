<?php

namespace Ocebot\KujiraTrack\Fin\Domain\Service;

use Ocebot\KujiraTrack\Fin\Domain\FinContract;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;

final class FinAggregatedUsdVolumeCalculator
{
    public function __construct(
        private readonly FinContractRepository $repository,
        private readonly FinCandlesUsdVolumeCalculator $usdCalculator
    ) {
    }

    public function __invoke(string $timeframe, int $page)
    {
        $contractCollection = $this->repository->findByType('fin');

        // Obtain USD volume for every contract
        $usdVolumes = array_map(
            fn (FinContract $contract) =>
            $this->usdCalculator->__invoke($contract->address(), $timeframe, $page),
            iterator_to_array($contractCollection)
        );

        // Aggregate and return values in unique array
        $flattenedUsdVolumes = array_merge(...$usdVolumes);

        $aggregatedUsdVolume = array_reduce($flattenedUsdVolumes, function ($carry, $item) {
            if (isset($carry[$item['time']])) {
                $carry[$item['time']]['value'] += $item['value'];
            } else {
                $carry[$item['time']] = $item;
            }
            return $carry;
        }, []);

        return array_values($aggregatedUsdVolume);
    }
}
