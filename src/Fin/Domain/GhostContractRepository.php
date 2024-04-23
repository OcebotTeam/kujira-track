<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

interface GhostContractRepository
{
    public function findAll(): GhostContractCollection;

    public function findByToken($token): ?GhostContract;

}
