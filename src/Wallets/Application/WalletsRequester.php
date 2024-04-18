<?php

namespace Ocebot\KujiraTrack\Wallets\Application;

use Ocebot\KujiraTrack\Wallets\Domain\WalletsService;

class WalletsRequester
{
    public function __construct(
        private readonly WalletsService $walletsService
    ) {
    }

    public function __invoke(): array
    {
        $wallets = $this->walletsService->request();

        return [
            "time" => $wallets->time(),
            "value" => $wallets->amount(),
        ];
    }
}
