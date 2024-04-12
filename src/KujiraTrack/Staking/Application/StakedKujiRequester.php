<?php

namespace Ocebot\KujiraTrack\Staking\Application;

use Ocebot\KujiraTrack\Staking\Domain\StakedKuji;
use Ocebot\KujiraTrack\Staking\Domain\StakedKujiService;

class StakedKujiRequester
{
    public function __construct(
        private readonly StakedKujiService $stakedKujiService
    ) {
    }

    public function __invoke(): StakedKuji
    {
        $stakedKuji = $this->stakedKujiService->request();
        return $this->stakedKujiService->request();
    }
}