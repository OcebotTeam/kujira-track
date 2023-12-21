<?php

namespace Ocebot\KujiraTrack\Fin\Application\Find;

use Ocebot\KujiraTrack\Fin\Domain\FinContract;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;

final class FinContractFinder
{
    private FinContractRepository $repository;

    public function __construct(FinContractRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $tickerId): FinContract
    {
        return $this->repository->getByTickerId($tickerId);
    }
}
