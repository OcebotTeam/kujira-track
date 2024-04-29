<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

interface FinContractRepository
{
    public function findByType(string $type): FinContractCollection;

    public function findByTickerId(FinContractTickerId $tickerId): ?FinContract;

    public function findByAddress(FinContractAddress $address): ?FinContract;

}
