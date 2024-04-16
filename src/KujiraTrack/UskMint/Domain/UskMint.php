<?php

namespace Ocebot\KujiraTrack\UskMint\Domain;

use Ocebot\KujiraTrack\Shared\Domain\KtDateTime;

class UskMint
{
    private readonly float $amount;
    private readonly KtDateTime $time;

    public function __construct(float $amount, string $time)
    {
        $this->amount = $amount;
        $this->time = new KtDateTime($time);
    }

    public function time(): int
    {
        return $this->time->unix();
    }

    public function amount(): float
    {
        return $this->amount;
    }

}
