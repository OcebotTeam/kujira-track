<?php

namespace Ocebot\KujiraTrack\Wallets\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class WalletsCollection extends Collection
{
    public function type(): string
    {
        return Wallets::class;
    }

    public function diff(): array
    {
        $walletsDiff = $this->toArray();

        // Process prev array to modify the value to be the difference between the current and the previous value
        $prev = null;
        foreach ($walletsDiff as $key => $value) {
            if ($prev !== null) {
                $walletsDiff[$key]['value'] = $value['value'] - $prev['value'];
            }
            $prev = $value;
        }

        // Remove the last element as it doesn't have a previous value
        array_shift($walletsDiff);

        return array_values($walletsDiff);
    }

    public function toArray(): array
    {
        return array_map(function (Wallets $wallets) {
            return [
                'time' => $wallets->time(),
                'value' => $wallets->amount()
            ];
        }, $this->items());
    }
}
