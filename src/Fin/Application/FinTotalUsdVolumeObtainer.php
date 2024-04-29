<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\Service\FinAggregatedUsdVolumeCalculator;

final class FinTotalUsdVolumeObtainer
{
    public function __construct(
        private readonly FinAggregatedUsdVolumeCalculator $usdVolumeAggregator
    ) {
    }

    public function __invoke(string $timeframe, int $page): array
    {
        return $this->usdVolumeAggregator->__invoke($timeframe, $page);
    }
}
