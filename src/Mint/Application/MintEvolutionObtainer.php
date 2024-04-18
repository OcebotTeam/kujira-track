<?php

namespace Ocebot\KujiraTrack\Mint\Application;

use Ocebot\KujiraTrack\Mint\Domain\MintValueRepository;

class MintEvolutionObtainer
{
    public function __construct(
        private readonly MintValueRepository $repository
    ) {
    }

    public function __invoke(string $collateral): array
    {
        $MintValues = $this->repository->getByCollateral($collateral);
        return $MintValues->toArray();
    }
}
