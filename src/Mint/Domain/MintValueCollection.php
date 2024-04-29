<?php

namespace Ocebot\KujiraTrack\Mint\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class MintValueCollection extends Collection
{
    private const PRECISION = 1000000;

    public function type(): string
    {
        return MintValue::class;
    }

    public function diff(): array
    {
        $prev = null;
        $mintValues = [];

        foreach ($this->items() as $key => $value) {
            if ($prev !== null) {
                $mintValues[$key]['value'] = $value->amount() / self::PRECISION  - $prev->amount() / self::PRECISION;
                $mintValues[$key]['time'] = $value->time();
            }
            $prev = $value;
        }

        // Remove the last element as it doesn't have a previous value to compare to
        array_pop($mintValues);

        return array_values($mintValues);
    }
}
