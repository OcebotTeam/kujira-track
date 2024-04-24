<?php

namespace Ocebot\KujiraTrack\Mint\Application;

use Ocebot\KujiraTrack\Mint\Domain\MintValue;
use Ocebot\KujiraTrack\Mint\Domain\MintValueRepository;

class MintEvolutionAggregatorDiff
{
    public function __construct(
        private readonly MintValueRepository $repository
    ) {
    }

    public function __invoke(): array
    {
        $mintValues = $this->repository->getAll();
        return $mintValues->diff();
    }
}
