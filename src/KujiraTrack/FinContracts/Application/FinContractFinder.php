<?php

namespace Ocebot\KujiraTrack\FinContracts\Application;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContract;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractNotFoundError;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractRepository;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractTickerId;

final class FinContractFinder
{
    public function __construct(
        private readonly FinContractRepository $repository)
    {
    }

    public function __invoke(string $tickerId): FinContract
    {
        $finContract = $this->repository->find(new FinContractTickerId($tickerId));

        if (is_null($finContract)) {
            throw new FinContractNotFoundError($tickerId);
        }

        return $finContract;
    }
}