<?php

namespace Ocebot\KujiraTrack\Wallets\Domain;

use Ocebot\KujiraTrack\Shared\Domain\DateTime;

class Wallets
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