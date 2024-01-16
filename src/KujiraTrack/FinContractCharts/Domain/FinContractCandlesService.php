<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

use DateTime;
use Ocebot\KujiraTrack\FinContracts\Domain\FinContractAddress;

interface FinContractCandlesService
{
    public function requestCandles(string $address, string $timeframe, string $from, string $to): FinContractCandles;
}