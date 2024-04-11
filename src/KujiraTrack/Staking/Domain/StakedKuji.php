<?php

namespace Ocebot\KujiraTrack\Staking\Domain;

use Ocebot\KujiraTrack\Shared\Domain\DateTime;

class StakedKuji
{
    private readonly DateTime $time;
    private readonly int $bondedTokens;
    private readonly int $notBondedTokens;

    public function __construct(string $time, int $bondedTokens, int $notBondedTokens)
    {
        $this->time = new DateTime($time);
        $this->bondedTokens = $bondedTokens;
        $this->notBondedTokens = $notBondedTokens;
    }

    public function time(): string
    {
        return $this->time->unix();
    }

    public function bondedTokens(): int
    {
        return $this->bondedTokens;
    }

    public function notBondedTokens(): int
    {
        return $this->notBondedTokens;
    }
}