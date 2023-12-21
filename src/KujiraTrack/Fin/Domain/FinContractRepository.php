<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

interface FinContractRepository
{
    public function getAll(): FinContracts;

    public function getByTickerId(string $tickerId): ?FinContract;
}
