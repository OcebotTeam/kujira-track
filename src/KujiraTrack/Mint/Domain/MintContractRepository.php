<?php

namespace Ocebot\KujiraTrack\Mint\Domain;

interface MintContractRepository
{
    public function findAll(): MintContractCollection;

    public function findByCollateral(string $collateral): ?MintContract;
}
