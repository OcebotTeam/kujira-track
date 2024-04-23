<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\FinCandle;
use Ocebot\KujiraTrack\Fin\Domain\FinCandlesService;
use Ocebot\KujiraTrack\Fin\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\TimeframeFactory;

final class FinCandlesLister
{
    public function __construct(
        private readonly FinCandlesService $candlesService,
        private readonly FinContractRepository $contractRepository
    ) {
    }

    public function __invoke(string $contractAddress, string $timeframe, int $page): array
    {
        $timeframeVO = TimeframeFactory::build($timeframe);
        $address = new FinContractAddress($contractAddress);
        $contract = $this->contractRepository->findByAddress($address);
        $candles = $this->candlesService->request($address, $timeframeVO, $page);

        return array_map(
            fn (FinCandle $candle) => [
                "time" => $candle->time(),
                "open" => $candle->openPrice() * (10 ** $contract->pricePrecision()),
                "close" => $candle->closePrice() * (10 ** $contract->pricePrecision()),
                "high" => $candle->highestPrice() * (10 ** $contract->pricePrecision()),
                "low" => $candle->lowestPrice() * (10 ** $contract->pricePrecision()),
                "value" => $candle->volume()
            ],
            iterator_to_array($candles)
        );
    }
}
