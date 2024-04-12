<?php

namespace Ocebot\KujiraTrack\UskMint\Domain;




interface UskMintService
{
    const BATCH_SIZE = 200;

    public function requestUskMint(string $collateral): UskMint;
}
