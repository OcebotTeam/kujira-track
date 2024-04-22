<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

interface FinCandlesService
{
    public const BATCH_SIZE = 5;

    public function request(FinContractAddress $address, Timeframe $timeframe, int $page): FinCandleCollection;
}
