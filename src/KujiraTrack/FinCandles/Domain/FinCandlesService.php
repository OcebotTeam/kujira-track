<?php

namespace Ocebot\KujiraTrack\FinCandles\Domain;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;

interface FinCandlesService
{
    const BATCH_SIZE = 200;

    public function requestCandles(FinContractAddress $address, Timeframe $timeframe, int $page): FinCandles;
}
