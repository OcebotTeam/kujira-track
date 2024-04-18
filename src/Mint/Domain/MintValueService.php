<?php

namespace Ocebot\KujiraTrack\Mint\Domain;

interface MintValueService
{
    public function request(string $contractAddress): MintValue;
}
