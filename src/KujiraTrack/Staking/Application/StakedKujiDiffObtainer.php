<?php

namespace Ocebot\KujiraTrack\Staking\Application;

use Ocebot\KujiraTrack\Staking\Domain\StakedKujiRepository;

class StakedKujiDiffObtainer
{
    public function __construct(
        private readonly StakedKujiRepository $stakedKujiRepository
    ) {
    }

    public function __invoke(): array
    {
        $stakedKujiCollection = $this->stakedKujiRepository->get();
        return $stakedKujiCollection->diff();
    }
}
