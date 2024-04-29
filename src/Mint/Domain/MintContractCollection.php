<?php

namespace Ocebot\KujiraTrack\Mint\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class MintContractCollection extends Collection
{
    protected function type(): string
    {
        return MintContract::class;
    }
}
