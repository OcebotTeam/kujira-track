<?php

namespace Ocebot\KujiraTrack\Mint\Application;

use Ocebot\KujiraTrack\Mint\Domain\MintValue;
use Ocebot\KujiraTrack\Mint\Domain\MintValueRepository;

class MintEvolutionObtainer
{
    public function __construct(
        private readonly MintValueRepository $repository
    ) {
    }

    public function __invoke(string $collateral): array
    {
        $mintValues = $this->repository->getByCollateral($collateral);

        return array_map(fn (MintValue $mintValue) => [
            "time" => $mintValue->time(),
            "value" => $mintValue->amount(),
        ], iterator_to_array($mintValues));
    }
}
