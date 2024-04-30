<?php

namespace Ocebot\KujiraTrack\Fin\Infrastructure;

final class FinContractRepositoryInMemoryDev extends FinContractRepositoryInMemory
{
    public function __construct()
    {
        parent::__construct();

        $finContracts = array_filter($this->contracts, function ($contract) {
            switch ($contract->tickerId()) {
                # FIN
                case 'KUJI_USK':
                case 'KUJI_USDC':
                case 'MNTA_KUJI':
                case 'MNTA_USK':
                case 'KUJI_axlUSDC':
                case 'wstETH_wETH':
                case 'wETH_USK':
                case 'wETH_USDC':
                # GHOST
                case 'USK':
                case 'USDC':
                case 'USDC.axl':
                    return true;
                default:
                    return false;
            }
        });

        $this->contracts = array_values($finContracts);
    }
}
