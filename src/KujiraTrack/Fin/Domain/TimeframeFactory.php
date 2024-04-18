<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

class TimeframeFactory
{
    public function build(string $precision): Timeframe
    {
        return match ($precision) {
            'daily' => new Timeframe($precision, '1D', 'day'),
            'monthly' => new Timeframe($precision, '1M', 'month'),
            default => throw new TimeFrameNotSupportedError($precision),
        };
    }

    public function list(): Timeframes
    {
        $timeframes = [
            'daily',
            'monthly'
        ];

        $timeframes = array_map(
            fn ($timeframe) => $this->build($timeframe),
            $timeframes
        );

        return new Timeframes($timeframes);
    }
}
