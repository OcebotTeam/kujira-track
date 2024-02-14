<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

abstract class TimeFrameFactory
{
    static function build(string $precision): TimeFrame
    {
        return match ($precision) {
            'daily' => new TimeFrameDaily($precision),
            'monthly' => new TimeFrameMonthly($precision),
            default => throw new TimeFrameNotSupportedError($precision),
        };
    }
}
