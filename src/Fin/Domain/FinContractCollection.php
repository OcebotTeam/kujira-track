<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

final class FinContractCollection extends Collection
{
    protected function type(): string
    {
        return FinContract::class;
    }
}
