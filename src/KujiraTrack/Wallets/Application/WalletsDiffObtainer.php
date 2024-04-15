<?php

namespace Ocebot\KujiraTrack\Wallets\Application;

use Ocebot\KujiraTrack\Wallets\Domain\WalletsRepository;

class WalletsDiffObtainer
{
    public function __construct(
        private readonly WalletsRepository $walletsRepository
    ) {
    }

    public function __invoke(): array
    {
        $wallets =  $this->walletsRepository->get();
        return $wallets->diff();
    }
}
