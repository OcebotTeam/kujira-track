<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\GhostContract;
use Ocebot\KujiraTrack\Fin\Domain\GhostContractRepository;

final class GhostContractLister
{
    public function __construct(private readonly GhostContractRepository $repository)
    {
    }

    public function __invoke(): array
    {
        $ghostContracts = $this->repository->findAll();

        return array_map(
            fn (GhostContract $ghostContracts) => [
                'address' => $ghostContracts->address(),
                'token' => $ghostContracts->token()
            ],
            iterator_to_array($ghostContracts)
        );
    }
}
