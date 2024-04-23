<?php

namespace Ocebot\KujiraTrack\Fin\Application;

use Ocebot\KujiraTrack\Fin\Domain\FinContractNotFoundError;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\FinContractTickerId;

final class FinContractFinder
{
    public function __construct(private readonly FinContractRepository $repository)
    {
    }

    public function __invoke(string $tickerId): array
    {
        $tickerId = new FinContractTickerId($tickerId);
        $finContract = $this->repository->findByTickerId($tickerId);

        if (is_null($finContract)) {
            throw new FinContractNotFoundError($tickerId);
        }

        return [
            'address' => $finContract->address(),
            'tickerId' => $finContract->tickerId(),
            'volumePrecision' => $finContract->volumePrecision(),
            'pricePrecision' => $finContract->pricePrecision(),
            'nominative' => $finContract->nominative(),
        ];
    }
}
