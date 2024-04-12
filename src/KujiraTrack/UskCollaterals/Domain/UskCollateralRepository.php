<?php

namespace Ocebot\KujiraTrack\UskCollaterals\Domain;

interface UskCollateralRepository
{
    public function findAll(): UskCollaterals;

    public function findByToken(string $token): ?UskCollateral;

}
