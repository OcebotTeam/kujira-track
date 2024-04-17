<?php

namespace Ocebot\KujiraTrack\Mint\Domain;

use DateTime;
use Ocebot\KujiraTrack\Shared\Domain\Collection;

class MintValueCollection extends Collection
{
    const DIVIDER = 1000000 ;
    public function type(): string
    {
        return MintValue::class;
    }

    public function toArray(): array
    {
        return array_map(function (MintValue $uskMint) {
            return [
                'time' => $uskMint->time(),
                'value' => $uskMint->amount(),
            ];
        }, $this->items());
    }
}
