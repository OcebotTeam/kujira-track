<?php

namespace Ocebot\KujiraTrack\Mint\Application;

use Ocebot\KujiraTrack\Mint\Domain\MintValueRepository;

class MintEvolutionAggregatorDiff
{
    public function __construct(
        private readonly MintValueRepository $uskMintRepository
    ) {
    }

    public function __invoke(): array
    {
        $uskMinted = $this->uskMintRepository->getAll();
        return $uskMinted->diff();
    }
}
