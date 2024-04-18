<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\FinCandlesService;
use Ocebot\KujiraTrack\Fin\Domain\FinChart;
use Ocebot\KujiraTrack\Fin\Domain\TimeframeFactory;

final class FinCandlesRequester
{
    public function __construct(
        private readonly TimeframeFactory $timeframeFactory,
        private readonly FinCandlesService $candlesService,

    ) {
    }

    public function __invoke(string $contractAddress, string $timeframe, int $page): array
    {
        $finContractChart = new FinChart(
            $this->candlesService,
            $contractAddress,
            $this->timeframeFactory->build($timeframe),
            $page
        );

        return $finContractChart->candles();
    }
}
