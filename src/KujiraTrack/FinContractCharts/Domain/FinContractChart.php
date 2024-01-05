<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

use DateTime;
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
        string $from,
        string $to)
    {
        $this->address = new FinContractAddress($contractAddress);
        $this->timeframe = new TimeFrame($timeFrame);
        $this->candles = $candlesService->requestCandles($this->address, $this->timeframe, $from, $to);
    }

    public function candlesJson()
    {
        return $this->candles->toJson();
    }
}