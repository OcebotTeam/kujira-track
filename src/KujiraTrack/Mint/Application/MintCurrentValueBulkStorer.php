<?php

namespace Ocebot\KujiraTrack\Mint\Application;

use Ocebot\KujiraTrack\Mint\Domain\MintContract;
use Ocebot\KujiraTrack\Mint\Domain\MintContractRepository;
use Ocebot\KujiraTrack\Mint\Domain\MintValueRepository;
use Ocebot\KujiraTrack\Mint\Domain\MintValueService;

final class MintCurrentValueBulkStorer
{
    public function __construct(
        private readonly MintContractRepository $contractRepository,
        private readonly MintValueRepository $valueRepository,
        private readonly MintValueService $valueService
    ) {
    }

    public function __invoke(): void
    {
        $mintContracts = $this->contractRepository->findAll();

        foreach ($mintContracts as $contract) {
            if ($contract instanceof MintContract) {
                $currentValue = $this->valueService->request($contract->address());
                $this->valueRepository->store($contract->collateral(), $currentValue);
            }
        }
    }
}
