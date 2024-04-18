<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

interface FinContractRepository
{
    public function findAll(): FinContracts;

    public function findByTickerId(FinContractTickerId $tickerId): ?FinContract;

    public function findByAddress(FinContractAddress $address): ?FinContract;

}
