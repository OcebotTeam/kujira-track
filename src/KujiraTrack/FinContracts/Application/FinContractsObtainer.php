<?php

namespace Ocebot\KujiraTrack\FinContracts\Application;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContract;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractRepository;

final class FinContractsObtainer
{
    public function __construct(private readonly FinContractRepository $repository)
    {
    }

    public function __invoke(): array
    {
        $finContracts = $this->repository->findAll();

        return array_map(
            fn (FinContract $finContract) => [
                'address' => $finContract->address(),
                'tickerId' => $finContract->tickerId(),
                'decimals' => $finContract->decimals(),
                'nominative' => $finContract->nominative(),
            ],
            iterator_to_array($finContracts)
        );
    }
}
