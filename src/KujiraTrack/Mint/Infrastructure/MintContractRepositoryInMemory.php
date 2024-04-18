<?php

namespace Ocebot\KujiraTrack\Mint\Infrastructure;

use Ocebot\KujiraTrack\Mint\Domain\MintContract;
use Ocebot\KujiraTrack\Mint\Domain\MintContractRepository;
use Ocebot\KujiraTrack\Mint\Domain\MintContractCollection;

class MintContractRepositoryInMemory implements MintContractRepository
{
    protected array $mintContracts = [];

    public function __construct()
    {
        $mintContractsJson = file_get_contents(__DIR__ . '/MintContracts.json');
        $mintContracts = json_decode($mintContractsJson, true);

        foreach ($mintContracts as $contract) {
            $this->mintContracts[] = new MintContract(
                $contract["collateral"],
                $contract["address"],
                $contract["margin"]
            );
        }
    }

    public function findAll(): MintContractCollection
    {
        return new MintContractCollection($this->mintContracts);
    }

    public function findByCollateral(string $collateral): ?MintContract
    {
        $mintContracts = $this->findAll();

        foreach ($mintContracts as $contract) {
            if ($contract instanceof MintContract && $contract->collateral() === $collateral) {
                return $contract;
            }
        }

        return null;
    }
}
