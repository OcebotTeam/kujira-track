<?php

namespace Ocebot\KujiraTrack\Staking\Domain;

use Ocebot\KujiraTrack\Shared\Domain\DateTime;

class StakedKuji
{
    private readonly DateTime $time;
    private readonly int $amount;

    public function __construct(string $time, int $amount)
    {
        $this->time = new DateTime($time);
        $this->amount = $amount;
    }

    public function time(): string
    {
        return $this->time->unix();
    }

    public function amount(): int
    {
        return $this->amount;
    }
}