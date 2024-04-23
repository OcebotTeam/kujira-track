<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\FinContract;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;

final class GhostContractLister
{
    public function __construct(private readonly FinContractRepository $repository)
    {
    }

    public function __invoke(): array
    {
        $finContracts = $this->repository->findByType('ghost');

        return array_map(
            fn (FinContract $finContract) => [
                'address' => $finContract->address(),
                'token' => $finContract->tickerId(),
            ],
            iterator_to_array($finContracts)
        );
    }
}
