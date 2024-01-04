<?php

namespace Ocebot\KujiraTrack\FinContracts\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

final class FinContracts extends Collection
{
    protected function type(): string
    {
        return FinContract::class;
    }
}
