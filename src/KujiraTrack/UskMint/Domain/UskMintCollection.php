<?php

namespace Ocebot\KujiraTrack\UskMint\Domain;

use DateTime;
use Ocebot\KujiraTrack\Shared\Domain\Collection;

class UskMintCollection extends Collection
{
    const DIVIDER = 1000000 ;
    public function type(): string
    {
        return UskMint::class;
    }

    public function toArray(): array
    {
        return array_map(function (UskMint $uskMint) {
            return [
                'time' => $uskMint->time(),
                'value' => $uskMint->amount(),
            ];
        }, $this->items());
    }
}
