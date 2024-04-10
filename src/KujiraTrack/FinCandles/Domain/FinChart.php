<?php

namespace Ocebot\KujiraTrack\FinCandles\Domain;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

final class FinChart extends AggregateRoot
{
    private readonly FinContractAddress $address;
    private readonly Timeframe $timeframe;
    private readonly FinCandles $candles;
    private readonly int $page;

    public function __construct(
        FinCandlesService $candlesService,
        string            $contractAddress,
        Timeframe         $timeFrame,
        int               $page,
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
