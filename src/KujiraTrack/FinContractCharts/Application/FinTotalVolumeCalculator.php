<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Application;

use Ocebot\KujiraTrack\FinContracts\Application\FinContractLister;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;

final class FinTotalVolumeCalculator
{
    public function __construct(
        private readonly FinContractLister $contractLister,
        private readonly FinContractChartRequester $ChartRequester
    )
    {
    }

    public function __invoke(string $timeframe, string $from, string $to): int
    {
        $contracts = $this->contractLister->__invoke();
        $totalVolume = 0;

        foreach ($contracts as $contract) {
            $candles = $this->ChartRequester->__invoke(new FinContractAddress($contract['address']), $timeframe, $from, $to);
            $totalVolume += array_reduce($candles, function ($carry, $candle) {
                return $carry + $candle['volume'];
            }, 0);
        }

        return $totalVolume;
    }
}