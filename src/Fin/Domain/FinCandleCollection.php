<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class FinCandleCollection extends Collection
{
    protected function type(): string
    {
        return FinCandle::class;
    }
}
