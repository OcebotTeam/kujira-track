<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\FinContractAddress;

final class FinTotalFeesCalculator
{
    public function __construct(
        private readonly FinContractLister          $contractLister,
        private readonly FinContractCandlesObtainer $chartRequester,
        private readonly FinContractFinder          $finContractFinder
    ) {
    }

    public function __invoke(string $from, string $to): float
    {
        $contracts = $this->contractLister->__invoke();
        $totalVolume = 0;

        $feesContracts = array_filter($contracts, function ($contract) {
            return $contract['tickerId'] !== 'axlUSDC_USDC';
        });
        $timeframe = 'day1';


        foreach ($feesContracts as $contract) {
            $candles = $this->chartRequester->__invoke(new FinContractAddress($contract['address']), $timeframe, $from, $to);
            $totalVolume += array_reduce($candles, function ($carry, $candle) use ($contract, $timeframe, $from, $to) {
                if ($contract['nominative']) {
                    //Find contract address using a ticker
                    $nominativeAddress = $this->finContractFinder->__invoke($contract['tickerId']);
                    $nominativeCandle = $this->chartRequester->__invoke(new FinContractAddress($nominativeAddress['address']), $timeframe, $from, $to);

                }
                $closePrice = $nominativeCandle[0]['close'] ?? 1;
                $dollarsVolume = $candle['volume'] * $closePrice;
                $normalizedVolume = $dollarsVolume / 10 ** $contract['decimals'];
                return $carry + $normalizedVolume;
            }, 0);
        }
        return $totalVolume * 0.0025;
    }

}
