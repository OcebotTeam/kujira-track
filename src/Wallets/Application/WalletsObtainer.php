<?php

namespace Ocebot\KujiraTrack\Wallets\Application;

use Ocebot\KujiraTrack\Wallets\Domain\Wallets;
use Ocebot\KujiraTrack\Wallets\Domain\WalletsRepository;

class WalletsObtainer
{
    public function __construct(
        private readonly WalletsRepository $walletsRepository
    ) {
    }

    public function __invoke(): array
    {
        $wallets = $this->walletsRepository->get();

        return array_map(function (Wallets $wallets) {
            return [
              'time' => $wallets->time(),
              'value' => $wallets->amount()
            ];
        }, iterator_to_array($wallets));
    }
}
