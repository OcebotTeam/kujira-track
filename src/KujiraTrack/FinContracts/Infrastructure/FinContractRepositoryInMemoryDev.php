<?php

namespace Ocebot\KujiraTrack\FinContracts\Infrastructure;

class FinContractRepositoryInMemoryDev extends FinContractRepositoryInMemory
{
    public function __construct()
    {
        parent::__construct();

        $finContracts = array_filter($this->finContracts, function ($contract) {
            switch ($contract->tickerId()) {
                case 'KUJI_USK':
                case 'KUJI_USDC':
                    return true;
                default:
                    return false;
            }
        });

        $this->finContracts = array_values($finContracts);
    }
}
