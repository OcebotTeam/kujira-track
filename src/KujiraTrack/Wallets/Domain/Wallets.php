<?php

namespace Ocebot\KujiraTrack\Wallets\Domain;

use Ocebot\KujiraTrack\Shared\Domain\DateTime;

class Wallets
{
    private readonly DateTime $time;
    private readonly int $wallets;

    public function __construct(string $time, int $wallets)
    {
        $this->time = new DateTime($time);
        $this->wallets = $wallets;
    }

    public function time(): string
    {
        return $this->time->unix();
    }

    public function wallets(): int
    {
        return $this->wallets;
    }

}