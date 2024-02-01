<?php

namespace Ocebot\KujiraTrack\Tokens\Application;

use Ocebot\KujiraTrack\Tokens\Domain\TokenPriceService;
use Ocebot\KujiraTrack\Tokens\Domain\TokenSymbol;

final class TokenPricer
{
    public function __construct(private readonly TokenPriceService $tokenPriceService)
    {
    }

    public function __invoke(string $symbol): float
    {
        $symbolVO = new TokenSymbol($symbol);
        return $this->tokenPriceService->price($symbolVO);
    }
}