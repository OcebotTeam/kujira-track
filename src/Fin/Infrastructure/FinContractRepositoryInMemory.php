<?php

namespace Ocebot\KujiraTrack\Fin\Infrastructure;

use Ocebot\KujiraTrack\Fin\Domain\FinContract;
use Ocebot\KujiraTrack\Fin\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Fin\Domain\FinContractCollection;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\FinContractTickerId;

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
                $contract['volumeDivider'],
                $contract['priceDivider'],
                $contract['nominative']
            );
        }
    }

    public function findAll(): FinContractCollection
    {
        return new FinContractCollection($this->finContracts);
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

    public function findByAddress(FinContractAddress $address): ?FinContract
    {
        $finContracts = $this->findAll();
        foreach ($finContracts as $finContract) {
            if ($finContract->address() === $address->value()) {
                return $finContract;
            }
        }
        return null;
    }
}
