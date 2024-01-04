<?php

namespace Ocebot\KujiraTrack\FinContractVolumes\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class FinContractCandles extends Collection
{

    protected function type(): string
    {
        return FinContractCandle::class;
    }
}