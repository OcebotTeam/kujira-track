<?php

namespace Ocebot\KujiraTrack\Staking\Domain;

interface StakedKujiRepository
{
    public function get(): StakedKujiCollection;

    public function store(StakedKuji $stakedKuji): void;
}
