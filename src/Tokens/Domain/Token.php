<?php

namespace Ocebot\KujiraTrack\Tokens\Domain;

final class Token
{
    private readonly TokenSymbol $symbol;
    private readonly TokenIbc $ibc;

    public function __construct(string $symbol, string $ibc)
    {
        $this->symbol = new TokenSymbol($symbol);
        $this->ibc = new TokenIbc($ibc);
    }

    public function symbol()
    {
        return $this->symbol->value();
    }

    public function ibc()
    {
        return $this->ibc->value();
    }

    public function isFactory()
    {
        return str_contains($this->ibc->value(), 'factory');
    }
}
