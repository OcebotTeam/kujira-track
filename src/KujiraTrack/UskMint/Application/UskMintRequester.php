<?php

namespace Ocebot\KujiraTrack\UskMint\Application;

use Ocebot\KujiraTrack\Staking\UskMint\UskMint;

class StakedKujiRequester
{
    public function __construct(
        private readonly StakedKujiService $stakedKujiService
    ) {
    }

    public function __invoke(): array
    {
        $stakedKuji = $this->stakedKujiService->request();

        return [
            "time" => $stakedKuji->time(),
            "value" => $stakedKuji->bondedTokens(),
            "notBondedTokens" => $stakedKuji->notBondedTokens()
        ];
    }
}
