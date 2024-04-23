<?php

namespace Ocebot\KujiraTrack\Fin\Infrastructure;

use Ocebot\KujiraTrack\Fin\Domain\FinContract;
use Ocebot\KujiraTrack\Fin\Domain\FinContractAddress;
use Ocebot\KujiraTrack\Fin\Domain\FinContractCollection;
use Ocebot\KujiraTrack\Fin\Domain\FinContractTickerId;
use Ocebot\KujiraTrack\Fin\Domain\GhostContract;
use Ocebot\KujiraTrack\Fin\Domain\GhostContractCollection;
use Ocebot\KujiraTrack\Fin\Domain\GhostContractRepository;
use Ocebot\KujiraTrack\Fin\Domain\GhostContractToken;

class GhostContractRepositoryInMemory implements GhostContractRepository
{
    protected array $ghostContracts = [];

    public function __construct()
    {
        $ghostContractsJson = file_get_contents(__DIR__ . '/ghostContracts.json');
        $ghostContracts = json_decode($ghostContractsJson, true);

        foreach ($ghostContracts as $contract) {
            $this->ghostContracts[] = new GhostContract(
                $contract["address"],
                $contract["token"],

            );
        }
    }

    public function findAll(): GhostContractCollection
    {
        return new GhostContractCollection($this->ghostContracts);
    }

    public function findByToken($token): ?GhostContract
    {
        $ghostContracts = $this->findAll();

        foreach ($ghostContracts as $ghostContract) {
            if ($ghostContract->token() === $token->value()) {
                return $ghostContract;
            }
        }

        return null;

    }
}
