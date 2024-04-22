<?php

namespace Ocebot\KujiraTrack\Fin\Infrastructure;

class FinContractRepositoryInMemoryDev extends FinContractRepositoryInMemory
{
    public function __construct()
    {
        parent::__construct();

        $finContracts = array_filter($this->finContracts, function ($contract) {
            switch ($contract->tickerId()) {
                case 'KUJI_USK':
                case 'KUJI_USDC':
                case 'MNTA_KUJI':
                case 'MNTA_USK':
                case 'KUJI_axlUSDC':
                    return true;
                default:
                    return false;
            }
        });

        $this->finContracts = array_values($finContracts);
    }
}
