<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\KtDateTime;

class FinCandle
{
    private readonly float $low;
    private readonly float $high;
    private readonly float $close;
    private readonly float $open;
    private readonly KtDateTime $time;
    private readonly int $volume;

    public function __construct(float $low, float $high, float $close, float $open, string $time, int $volume)
    {
        $this->volume = $volume;
        $this->time = new KtDateTime($time);
        $this->open = $open;
        $this->close = $close;
        $this->high = $high;
        $this->low = $low;
    }

    public function lowestPrice(): float
    {
        return $this->low;
    }

    public function highestPrice(): float
    {
        return $this->high;
    }

    public function closePrice(): float
    {
        return $this->close;
    }

    public function openPrice(): float
    {
        return $this->open;
    }

    public function time(): int
    {
        return $this->time->unix();
    }

    public function volume(): int
    {
        return $this->volume;
    }


}
