<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

final class FinContractChart extends AggregateRoot
{
    private readonly FinContractAddress $address;
    private readonly Timeframe $timeframe;
    private readonly FinContractCandles $candles;
    private readonly Timeframe $timeFrame;
    private readonly int $page;

    public function __construct(
        FinContractCandlesService $candlesService,
        string $contractAddress,
        Timeframe $timeFrame,
        int $page,
    ) {
        $this->timeframe = $timeFrame;
        $this->page = $page;
        $this->address = new FinContractAddress($contractAddress);
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
