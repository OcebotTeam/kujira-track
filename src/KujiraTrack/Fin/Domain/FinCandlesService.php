<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

interface FinCandlesService
{
    public const BATCH_SIZE = 200;

    public function requestCandles(FinContractAddress $address, Timeframe $timeframe, int $page): FinCandles;
}
