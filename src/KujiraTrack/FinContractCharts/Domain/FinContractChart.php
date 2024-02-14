<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

final class FinContractChart extends AggregateRoot
{
    private readonly FinContractAddress $address;
    private readonly TimeFrame $timeframe;
    private readonly FinContractCandles $candles;

    public function __construct(
        FinContractCandlesService $candlesService,
        string $contractAddress,
        string $timeFrame,
        private readonly string $page,
    ) {
        $this->address = new FinContractAddress($contractAddress);
        $this->timeframe = TimeFrameFactory::build($timeFrame);

        $this->candles = $candlesService->requestCandles(
            $this->address,
            $this->timeframe,
            $this->page
        );
    }

    public function candles(): array
    {
        return $this->candles->toArray();
    }
}
