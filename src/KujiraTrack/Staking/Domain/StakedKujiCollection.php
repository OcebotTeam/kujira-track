<?php

namespace Ocebot\KujiraTrack\Staking\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class StakedKujiCollection extends Collection
{
    public function type(): string
    {
        return StakedKuji::class;
    }

    public function toArray(): array
    {
        return array_map(function (StakedKuji $stakedKuji) {
            return [
                'time' => $stakedKuji->time(),
                'value' => $stakedKuji->bondedTokens()
            ];
        }, $this->items());
    }

    public function diff(): array
    {
        $stakedKujiDiff = $this->toArray();

        // Process prev array to modify the value to be the difference between the current and the previous value
        $prev = null;
        foreach ($stakedKujiDiff as $key => $value) {
            if ($prev !== null) {
                $stakedKujiDiff[$key]['value'] = $value['value'] - $prev['value'];
            }
            $prev = $value;
        }

        // Remove the first element as it doesn't have a previous value
        unset($stakedKujiDiff[0]);

        return array_values($stakedKujiDiff);
    }
}
