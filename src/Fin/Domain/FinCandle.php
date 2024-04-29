<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\KtDateTime;

class FinCandle
{
    private readonly KtDateTime $time;

    public function __construct(
        private readonly float $low,
        private readonly float $high,
        private readonly float $close,
        private readonly float $open,
        private readonly int $volume,
        string $time,
    )
    {
        $this->time = new KtDateTime($time);
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

    public function volume(): int
    {
        return $this->volume;
    }

    public function time(): int
    {
        return $this->time->unix();
    }
}
