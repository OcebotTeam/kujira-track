<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Application;

use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandlesService;
use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractChart;
use Ocebot\KujiraTrack\FinContractCharts\Domain\TimeframeFactory;

final class FinContractChartRequester
{
    public function __construct(
        private readonly TimeframeFactory $timeframeFactory,
        private readonly FinContractCandlesService $candlesService
    ) {}

    public function __invoke(string $contractAddress, string $timeframe, int $page): array
    {
        $finContractChart = new FinContractChart(
            $this->candlesService,
            $contractAddress,
            $this->timeframeFactory->build($timeframe),
            $page
        );
        
        return $finContractChart->candles();
    }
}
