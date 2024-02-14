<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;

interface FinContractCandlesService
{
    public function requestCandles(FinContractAddress $address, TimeFrame $timeframe, int $page): FinContractCandles;
}
