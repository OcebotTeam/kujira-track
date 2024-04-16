<?php

namespace Ocebot\KujiraTrack\UskMint\Application;

use Ocebot\KujiraTrack\UskMint\Domain\UskMintRepository;

class UskMintAggregator
{
    public function __construct(
        private readonly UskMintRepository $uskMintRepository
    ) {
    }

    public function __invoke(): array
    {
        $uskMinted = $this->uskMintRepository->getAll();
        return $uskMinted->toArray();
    }
}
