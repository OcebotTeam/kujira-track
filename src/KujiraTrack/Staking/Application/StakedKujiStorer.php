<?php

namespace Ocebot\KujiraTrack\Staking\Application;

use Ocebot\KujiraTrack\Staking\Domain\StakedKuji;
use Ocebot\KujiraTrack\Staking\Domain\StakedKujiRepository;

class StakedKujiStorer
{
    public function __construct(
        private readonly StakedKujiRepository $stakedKujiRepository
    ) {
    }

    public function __invoke(string $time, int $bondedTokens, int $notBondedTokens): void
    {
        $stakedKuji = new StakedKuji($time, $bondedTokens, $notBondedTokens);
        $this->stakedKujiRepository->store($stakedKuji);
    }
}
