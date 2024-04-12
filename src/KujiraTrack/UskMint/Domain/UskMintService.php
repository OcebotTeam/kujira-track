<?php

namespace Ocebot\KujiraTrack\UskMint\Domain;

interface UskMintService
{
    public const BATCH_SIZE = 200;

    public function requestUskMint(string $collateral): UskMint;
}
