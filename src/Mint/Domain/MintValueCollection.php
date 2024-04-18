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

    public function diff(): self
    {
        $prev = null;
        $mintValues = [];

        foreach ($this->items() as $key => $value) {
            if ($prev !== null) {
                $mintValues[$key]['value'] = $value['value'] / self::DIVIDER  - $prev['value'] / self::DIVIDER;
            }
            $prev = $value;
        }

        // Remove the last element as it doesn't have a previous value to compare to
        array_pop($mintValues);

        return new self($mintValues);
    }
}
