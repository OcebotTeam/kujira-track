<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class FinContractCandles extends Collection
{
    protected function type(): string
    {
        return FinContractCandle::class;
    }

    public function toArray(): array
    {
        $primitiveItems = [];

        foreach ($this->items() as $item) {
            $primitiveItems[] = $item->toArray();
        }

        return $primitiveItems;
    }
}