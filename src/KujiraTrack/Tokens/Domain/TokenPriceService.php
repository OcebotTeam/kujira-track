<?php

namespace Ocebot\KujiraTrack\Tokens\Domain;

interface TokenPriceService
{
    public function price(TokenSymbol $ticker): float;
}