<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

class FinContractCandle
{
    private readonly float $low;
    private readonly float $high;
    private readonly float $close;
    private readonly float $open;
    private readonly FinContractCandleDateTime $time;
    private readonly int $volume;

    public function __construct(float $low, float $high, float $close, float $open, string $time, int $volume)
    {
        $this->volume = $volume;
        $this->time = new FinContractCandleDateTime($time);
        $this->open = $open;
        $this->close = $close;
        $this->high = $high;
        $this->low = $low;
    }

    public function toArray()
    {
        return [
            "value" => $this->volume,
            "time" => (int) $this->time->unix(),
            "open" => $this->open,
            "close" => $this->close,
            "high" => $this->high,
            "low" => $this->low,
        ];
    }
}
