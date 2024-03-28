<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;

interface FinContractCandlesService
{
    const BATCH_SIZE = 10;

    public function requestCandles(FinContractAddress $address, TimeFrame $timeframe, int $page): FinContractCandles;
}
