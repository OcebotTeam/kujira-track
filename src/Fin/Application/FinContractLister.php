<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\FinContract;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;

final class FinContractLister
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
