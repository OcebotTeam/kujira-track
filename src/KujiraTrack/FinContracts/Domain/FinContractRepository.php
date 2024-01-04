<?php

namespace Ocebot\KujiraTrack\FinContracts\Domain;

interface FinContractRepository
{
    public function findAll(): FinContracts;

    public function find(FinContractTickerId $tickerId): ?FinContract;
}
