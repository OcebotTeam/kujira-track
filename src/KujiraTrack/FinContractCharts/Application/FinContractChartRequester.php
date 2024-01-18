<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Application;

use DateTime;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandlesService;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractChart;

final class FinContractChartRequester
{
    public function __construct(
        private readonly FinContractCandlesService $candlesService
    ){}

    public function __invoke(string $contractAddress, string $timeframe, string $from, string $to): array
    {
        $finContractChart = new FinContractChart($this->candlesService, $contractAddress, $timeframe, $from, $to);
        return $finContractChart->candles();
    }
}