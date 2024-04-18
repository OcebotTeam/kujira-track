<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\Timeframe;
use Ocebot\KujiraTrack\Fin\Domain\TimeframeFactory;

class TimeframeLister
{
    public function __construct(
        private readonly TimeframeFactory $timeframeFactory
    ) {
    }

    public function __invoke()
    {
        $timeframes = $this->timeframeFactory->list();

        return array_map(
            fn (Timeframe $timeframe) => [
                'precision' => $timeframe->precision(),
                'apiKey' => $timeframe->apiKey(),
                'dateTimeKey' => $timeframe->dateTimeKey()
            ],
            iterator_to_array($timeframes)
        );
    }
}
