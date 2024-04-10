<?php

namespace Ocebot\KujiraTrack\FinCandles\Application;

use Ocebot\KujiraTrack\FinCandles\Domain\TimeframeFactory;

class TimeframeLister
{
    public function __construct(
       private readonly TimeframeFactory $timeframeFactory
    ) {}

    public function __invoke()
    {
        $timeframes = $this->timeframeFactory->list();
        
        return array_map(
            fn($timeframe) => $timeframe->toArray(),
            iterator_to_array($timeframes)
        );
    }
}