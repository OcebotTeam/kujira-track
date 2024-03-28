<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Application;

use DateTime;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandlesService;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractChart;

final class FinContractChartRequester
{
    public function __construct(private readonly FinContractCandlesService $candlesService)
    {
    }

    public function __invoke(string $contractAddress, string $timeframe, int $page): array
    {
        $finContractChart = new FinContractChart($this->candlesService, $contractAddress, $timeframe, $page);
        return $finContractChart->candles();
    }
}
