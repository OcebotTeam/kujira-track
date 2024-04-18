<?php

namespace Ocebot\KujiraTrack\Wallets\Application;

use Ocebot\KujiraTrack\Wallets\Domain\Wallets;
use Ocebot\KujiraTrack\Wallets\Domain\WalletsRepository;

class WalletsStorer
{
    public function __construct(
        private readonly WalletsRepository $walletsRepository
    ) {
    }

    public function __invoke(string $time, int $amount): void
    {
        $wallets = new Wallets($time, $amount);
        $this->walletsRepository->store($wallets);
    }
}
