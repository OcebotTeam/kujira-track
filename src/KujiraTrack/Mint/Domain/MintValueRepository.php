<?php

namespace Ocebot\KujiraTrack\Mint\Domain;

interface MintValueRepository
{
    public function getAll(): MintValueCollection;

    public function getByCollateral(string $collateral): MintValueCollection;

    public function store(string $collateral, MintValue $mintValue): void;
}
