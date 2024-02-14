<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

final class TimeFrameMonthly extends TimeFrame
{
    public function dateTimeKey(): string
    {
        return 'month';
    }

    public function apiKey(): string
    {
        return '1M';
    }
}