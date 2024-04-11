<?php

namespace Ocebot\KujiraTrack\Staking\Domain;

interface StakedKujiRepository
{
    public function get(): StakedKujiCollection;
}