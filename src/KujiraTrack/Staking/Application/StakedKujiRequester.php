<?php

namespace Ocebot\KujiraTrack\Staking\Application;

use Ocebot\KujiraTrack\Staking\Domain\StakedKujiService;

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