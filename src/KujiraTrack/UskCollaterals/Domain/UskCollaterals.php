<?php

namespace Ocebot\KujiraTrack\UskCollaterals\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class UskCollaterals extends Collection
{
    protected function type(): string
    {
        return UskCollateral::class;
    }
}
