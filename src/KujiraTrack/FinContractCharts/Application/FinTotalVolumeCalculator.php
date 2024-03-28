<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Application;

use Ocebot\KujiraTrack\FinContracts\Application\FinContractLister;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;
use Ocebot\KujiraTrack\FinContracts\Application\FinContractFinder;

final class FinTotalVolumeCalculator
{
    public function __construct(
        private readonly FinContractLister $contractLister,
        private readonly FinContractChartRequester $chartRequester,
        private readonly FinContractFinder $finContractFinder
    )
    {
    }

    public function __invoke(string $timeframe, int $page): int
    {
        $contracts = $this->contractLister->__invoke();
        $totalVolume = 0;

        foreach ($contracts as $contract) {
            $candles = $this->chartRequester->__invoke(new FinContractAddress($contract['address']), $timeframe, $page);

            $totalVolume += array_reduce($candles, function ($carry, $candle) use ($contract, $timeframe, $page) {
                if ($contract['nominative']) {
                    //Find contract address using a ticker
                    $nominativeAddress = $this->finContractFinder->__invoke($contract['tickerId']);
                    $nominativeCandle = $this->chartRequester->__invoke(new FinContractAddress($nominativeAddress['address']), $timeframe, $page);
                }

                $closePrice = $nominativeCandle[0]['close'] ?? 1;
                $dollarsVolume = $candle['volume'] * $closePrice;
                $normalizedVolume = $dollarsVolume / 10**$contract['decimals'];

                return $carry + $normalizedVolume;
            }, 0);
        }

        return $totalVolume;
    }
}