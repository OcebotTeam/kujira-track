<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

class TimeframeFactory
{
    public static function build(string $precision): Timeframe
    {
        return match ($precision) {
            'daily' => new Timeframe($precision, '1D', 'day', 'Y-m-d'),
            'monthly' => new Timeframe($precision, '1M', 'month', 'Y-m'),
            default => throw new TimeFrameNotSupportedError($precision),
        };
    }

    public static function list(): TimeframeCollection
    {
        $timeframes = [
            'daily',
            'monthly'
        ];

        $timeframes = array_map(
            fn ($timeframe) => self::build($timeframe),
            $timeframes
        );

        return new TimeframeCollection($timeframes);
    }
}
