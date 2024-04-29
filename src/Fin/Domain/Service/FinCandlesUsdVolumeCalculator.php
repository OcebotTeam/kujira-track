<?php

namespace Ocebot\KujiraTrack\Fin\Domain\Service;

use Ocebot\KujiraTrack\Fin\Domain\FinCandle;
use Ocebot\KujiraTrack\Fin\Domain\FinCandlesService;
use Ocebot\KujiraTrack\Fin\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\FinContractTickerId;
use Ocebot\KujiraTrack\Fin\Domain\TimeframeFactory;

final class FinCandlesUsdVolumeCalculator
{
    public function __construct(
        private readonly FinContractRepository $repository,
        private readonly FinCandlesService $candlesService
    ) {
    }

    public function __invoke(string $address,string $timeframe, int $page): array
    {
        // Obtain candles for given page and timeframe
        $address = new FinContractAddress($address);
        $timeframe = TimeframeFactory::build($timeframe);
        $contract = $this->repository->findByAddress($address);
        $candles = $this->candlesService->request($address, $timeframe, $page);

        // Create result array and apply decimal correction
        $usdValues = array_map(fn (FinCandle $candle) => [
            'value' => $candle->volume(),
            'time' => $candle->time()
        ], iterator_to_array($candles));

        // Apply price correction if it has nominative
        if ($contract->hasNominative()) {
            // Obtain nominative candles for the same period
            $nominativeTickerId = new FinContractTickerId($contract->nominative());
            $nominativeContract = $this->repository->findByTickerId($nominativeTickerId);
            $nominativeAddress = new FinContractAddress($nominativeContract->address());
            $nominativeCandles = $this->candlesService->request($nominativeAddress, $timeframe, $page);

            $pos = 0;
            foreach ($nominativeCandles as $nominativeCandle) {
                if ($nominativeCandle instanceof FinCandle) {
                    $usdValues[$pos]['value'] *= $nominativeCandle->closePrice();
                    $pos++;
                }
            }
        }

        return $usdValues;
    }
}
