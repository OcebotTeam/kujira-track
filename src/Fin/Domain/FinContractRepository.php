<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

interface FinContractRepository
{
    public function findAll(): FinContractCollection;

    public function findByTickerId(FinContractTickerId $tickerId): ?FinContract;

    public function findByAddress(FinContractAddress $address): ?FinContract;

}
