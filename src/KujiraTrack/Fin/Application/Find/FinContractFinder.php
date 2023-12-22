<?php

namespace Ocebot\KujiraTrack\Fin\Application\Find;

use Ocebot\KujiraTrack\Fin\Domain\FinContract;
use Ocebot\KujiraTrack\Fin\Domain\FinContractNotFound;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\FinContractTickerId;

final class FinContractFinder
{
    public function __construct(
        private readonly FinContractRepository $repository)
    {
    }

    public function __invoke(FinContractTickerId $tickerId): FinContract
    {
        $finContract = $this->repository->find($tickerId);

        if (is_null($finContract)) {
            throw new FinContractNotFound($tickerId);
        }

        return $finContract;
    }
}