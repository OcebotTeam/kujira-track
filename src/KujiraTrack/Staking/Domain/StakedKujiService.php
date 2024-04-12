<?php

namespace Ocebot\KujiraTrack\Staking\Domain;

interface StakedKujiService
{
    public function request(): StakedKuji;
}