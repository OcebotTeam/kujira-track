<?php

namespace Ocebot\KujiraTrack\Wallets\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class WalletsCollection extends Collection
{
    public function type(): string
    {
        return Wallets::class;
    }
}
