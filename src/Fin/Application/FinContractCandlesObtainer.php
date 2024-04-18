<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\FinCandle;
use Ocebot\KujiraTrack\Fin\Domain\FinCandlesService;
use Ocebot\KujiraTrack\Fin\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Fin\Domain\TimeframeFactory;

final class FinContractCandlesObtainer
{
    public function __construct(
        private readonly TimeframeFactory $timeframeFactory,
        private readonly FinCandlesService $candlesService,
    ) {
    }

    public function __invoke(string $contractAddress, string $timeframe, int $page): array
    {
        $timeframeVO = $this->timeframeFactory->build($timeframe);
        $address = new FinContractAddress($contractAddress);
        $candles = $this->candlesService->request($address, $timeframeVO, $page);

        return array_map(
            fn (FinCandle $candle) => [
                "time" => $candle->time(),
                "open" => $candle->openPrice(),
                "close" => $candle->closePrice(),
                "high" => $candle->highestPrice(),
                "low" => $candle->lowestPrice(),
                "value" => $candle->volume()
            ],
            iterator_to_array($candles)
        );
    }
}
