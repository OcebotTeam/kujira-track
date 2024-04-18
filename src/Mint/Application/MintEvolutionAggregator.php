<?php

namespace Ocebot\KujiraTrack\Mint\Application;

use Ocebot\KujiraTrack\Mint\Domain\MintValue;
use Ocebot\KujiraTrack\Mint\Domain\MintValueRepository;

class MintEvolutionAggregator
{
    public function __construct(
        private readonly MintValueRepository $repository
    ) {
    }

    public function __invoke(): array
    {
        $mintValues = $this->repository->getAll();

        return array_map(fn (MintValue $mintValue) => [
            "time" => $mintValue->time(),
            "value" => $mintValue->amount(),
        ], iterator_to_array($mintValues));
    }
}
