<?php

namespace Ocebot\KujiraTrack\UskMint\Domain;

interface UskMintRepository
{
    public function getAll(): UskMintCollection;
    public function getByCollateral(string $collateral): UskMintCollection;
}
