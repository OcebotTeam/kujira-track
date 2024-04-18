<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\FinContractAddress;

final class FinTotalVolumeCalculator
{
    public function __construct(
        private readonly FinContractLister          $contractLister,
        private readonly FinContractCandlesObtainer $chartRequester,
        private readonly FinContractFinder          $finContractFinder
    ) {
    }

    public function __invoke(string $timeframe, int $page): array
    {
        $contracts = $this->contractLister->__invoke();
        $results = [];
        $dailyAggregatedValues = [];

        // Aggregate values
        foreach ($contracts as $contract) {
            $candles = $this->chartRequester->__invoke(new FinContractAddress($contract['address']), $timeframe, $page);
            $candlePosition = 0;

            foreach ($candles as $candle) {
                $date = date('Y-m-d', strtotime($candle['time']));
                $normalizeVolume = $this->normalizeVolume($contract, $timeframe, $page, floatval($candle['value']), $candlePosition);
                $dailyAggregatedValues[$date] = isset($dailyAggregatedValues[$date]) ? $dailyAggregatedValues[$date] + $normalizeVolume : $normalizeVolume;
                $candlePosition++;
            }
        }

        // Format results
        foreach ($dailyAggregatedValues as $date => $value) {
            $results[] = [
                'time' => $date,
                'value' => strval($value)
            ];
        }

        return $results;
    }

    private function normalizeVolume(array $contract, string $timeframe, int $page, float $volume, int $candlePosition)
    {
        $value = $volume / (10 ** $contract['decimals']);

        if ($contract['nominative']) {
            $nominativeContract = $this->finContractFinder->__invoke($contract['nominative']);
            $nominativeCandle = $this->chartRequester->__invoke(new FinContractAddress($nominativeContract['address']), $timeframe, $page);
            $value *= $nominativeCandle[$candlePosition]['close'];
        }

        return $value;
    }
}
