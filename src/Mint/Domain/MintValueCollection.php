<?php

namespace Ocebot\KujiraTrack\Mint\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class MintValueCollection extends Collection
{
    private const DIVIDER = 1000000;

    public function type(): string
    {
        return MintValue::class;
    }

    public function diff(): array
    {
        $mintValue = $this->toArray();

        // Process prev array to modify the value to be the difference between the current and the previous value
        $prev = null;
        foreach ($mintValue as $key => $value) {
            if ($prev !== null) {
                $mintValue[$key]['value'] = $value['value'] / self::DIVIDER  - $prev['value'] / self::DIVIDER;
            }
            $prev = $value;
        }

        // Remove the last element as it doesn't have a previous value
        array_pop($mintValue);

        return array_values($mintValue);
    }

    public function toArray(): array
    {
        $mintValues = array_map(function (MintValue $uskMint) {
            return [
                'time' => $uskMint->time(),
                'value' => $uskMint->amount(),
            ];
        }, $this->items());

        return array_values($mintValues);
    }
}
