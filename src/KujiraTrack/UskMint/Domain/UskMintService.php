<?php

namespace Ocebot\KujiraTrack\UskMint\Domain;

interface UskMintService
{
    public function request(string $contract): UskMint;
}
