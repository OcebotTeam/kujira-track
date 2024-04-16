<?php

namespace Ocebot\KujiraTrack\UskMint\Application;

use Ocebot\KujiraTrack\UskMint\Domain\UskMintCollection;
use Ocebot\KujiraTrack\UskMint\Domain\UskMintRepository;

class UskMintObtainer
{
    public function __construct(
        private readonly UskMintRepository $uskMintRepository
    ) {
    }

    public function __invoke(string $collateral): array
    {
        $uskMintCollection = $this->uskMintRepository->getByCollateral($collateral);
        return $uskMintCollection->toArray();
    }
}
