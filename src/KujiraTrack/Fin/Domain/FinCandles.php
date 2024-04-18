<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class FinCandles extends Collection
{
    protected function type(): string
    {
        return FinCandle::class;
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
