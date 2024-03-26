<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Application;

use Ocebot\KujiraTrack\FinContracts\Application\FinContractLister;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;

final class FinTotalFeesCalculator
{
    public function __construct(
        private readonly FinContractLister $contractLister,
        private readonly FinContractChartRequester $chartRequester
    )
    {
    }

    public function __invoke(string $from, string $to): float
    {
        $contracts = $this->contractLister->__invoke();
        $totalVolume = 0;

        $feesContracts = array_filter($contracts, function ($contract) {
            return $contract['tickerId'] !== 'axlUSDC_USDC';
        });


        foreach ($feesContracts as $contract) {
            $candles = $this->chartRequester->__invoke(new FinContractAddress($contract['address']), 'day1', $from, $to);
            $totalVolume += array_reduce($candles, function ($carry, $candle) {
                return $carry + $candle['volume'];
            }, 0);
        }

        return $totalVolume;
    }
}
