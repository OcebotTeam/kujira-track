<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

final class GhostContractCollection extends Collection
{
    protected function type(): string
    {
        return GhostContract::class;
    }
}
