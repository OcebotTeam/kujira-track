<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

interface FinContractRepository
{
    public function findAll(): FinContracts;

    public function find(FinContractTickerId $tickerId): ?FinContract;
}
