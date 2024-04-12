<?php

namespace Ocebot\KujiraTrack\Staking\Domain;

use Ocebot\KujiraTrack\Shared\Domain\KtDateTime;

class StakedKuji
{
    private readonly KtDateTime $time;
    private readonly int $bondedTokens;
    private readonly int $notBondedTokens;

    public function __construct(string $time, int $bondedTokens, int $notBondedTokens)
    {
        $this->time = new KtDateTime($time);
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