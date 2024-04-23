<?php

namespace Ocebot\KujiraTrack\Fin\Infrastructure;

use Ocebot\KujiraTrack\Fin\Domain\FinContract;
use Ocebot\KujiraTrack\Fin\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Fin\Domain\FinContractCollection;
use Ocebot\KujiraTrack\Fin\Domain\FinContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\FinContractTickerId;

class FinContractRepositoryInMemory implements FinContractRepository
{
    protected array $contracts;

    public function __construct()
    {
        $finContractsJson = file_get_contents(__DIR__ . '/finContracts.json');
        $finContracts = json_decode($finContractsJson, true);

        foreach ($finContracts as $contract) {
            $this->contracts[] = new FinContract(
                $contract["address"],
                $contract["tickerId"],
                $contract['volumePrecision'],
                $contract['pricePrecision'],
                $contract['nominative'],
                'fin'
            );
        }

        $ghostContractsJson = file_get_contents(__DIR__ . '/ghostContracts.json');
        $ghostContracts = json_decode($ghostContractsJson, true);

        foreach ($ghostContracts as $contract) {
            $this->contracts[] = new FinContract(
                $contract["address"],
                $contract["token"],
                1,
                1,
                null,
                'ghost'
            );
        }
    }

    private function findAll(): FinContractCollection
    {
        return new FinContractCollection($this->contracts);
    }

    public function findByType(string $type): FinContractCollection
    {
        $finContracts = $this->findAll();
        $filteredContracts = [];

        foreach ($finContracts as $finContract) {
            if ($finContract->type() === $type) {
                $filteredContracts[] = $finContract;
            }
        }

        return new FinContractCollection($filteredContracts);
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
