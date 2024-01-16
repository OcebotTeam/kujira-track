<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

final class FinContractChart extends AggregateRoot
{
    private readonly FinContractAddress $address;
    private readonly TimeFrame $timeframe;
    private readonly FinContractCandles $candles;
    private readonly FinContractCandleDateTime $from;
    private readonly FinContractCandleDateTime $to;

    public function __construct(
        FinContractCandlesService $candlesService,
        string $contractAddress,
        string $timeFrame,
        string $from,
        string $to)
    {

        $this->from = new FinContractCandleDateTime($from);
        $this->to = new FinContractCandleDateTime($to);
        $this->address = new FinContractAddress($contractAddress);
        $this->timeframe = new TimeFrame($timeFrame);

        $this->candles = $candlesService->requestCandles(
            $this->address->value(),
            $this->timeframe->precision(),
            $this->from->value(),
            $this->to->value()
        );
    }

    public function candles(): array
    {
        return $this->candles->toArray();
    }
}