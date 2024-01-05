<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

use Ocebot\KujiraTrack\FinContractCharts\Domain\FinContractCandle;
use Ocebot\KujiraTrack\Shared\Domain\Collection;

class FinContractCandles extends Collection
{
    protected function type(): string
    {
        return FinContractCandle::class;
    }

    public function toJson(): string {
        return json_encode($this->items());
    }
}