<?php

namespace Ocebot\KujiraTrack\Wallets\Domain;

use Ocebot\KujiraTrack\Shared\Domain\KtDateTime;

class Wallets
{
    private readonly KtDateTime $time;
    private readonly int $amount;

    public function __construct(string $time, int $amount)
    {
        $this->time = new KtDateTime($time);
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
