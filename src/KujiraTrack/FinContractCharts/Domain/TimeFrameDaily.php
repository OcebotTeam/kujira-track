<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

final class TimeFrameDaily extends TimeFrame
{
    public function dateTimeKey(): string
    {
        return 'day';
    }

    public function apiKey(): string
    {
        return '1D';
    }
}