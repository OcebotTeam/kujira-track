<?php

namespace Ocebot\KujiraTrack\FinContracts\Infrastructure;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContract;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractRepository;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContracts;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractTickerId;

class FinContractRepositoryInMemory implements FinContractRepository
{
    protected array $finContracts = [];

    public function __construct()
    {
        $finContractsJson = file_get_contents(__DIR__ . '/finContracts.json');
        $finContracts = json_decode($finContractsJson, true);

        foreach ($finContracts as $contract) {
            $this->finContracts[] = new FinContract(
                $contract["address"],
                $contract["tickerId"],
                $contract['decimals'] ?? 6,
                $contract['nominative'] ?? null
            );
        }
    }

    public function findAll(): FinContracts
    {
        return new FinContracts($this->finContracts);
    }

    public function findByTickerId(FinContractTickerId $tickerId): ?FinContract
    {
        $finContracts = $this->findAll();

        foreach ($finContracts as $finContract) {
            if ($finContract->tickerId() === $tickerId->value()) {
                return $finContract;
            }
        }

        return null;
    }
}
