<?php

namespace Ocebot\KujiraTrack\Wallets\Application;

use Ocebot\KujiraTrack\Wallets\Domain\WalletsRepository;
use Ocebot\KujiraTrack\Wallets\Domain\Wallets;

class WalletsObtainer
{
    public function __construct(
      private readonly WalletsRepository $walletsRepository
    ) {
    }

    public function __invoke(): array {
      $wallets = $this->walletsRepository->get();

      return array_map(function (Wallets $wallets) {
        return [
          'time' => $wallets->time(),
          'value' => $wallets->amount(),
        ];
      }, iterator_to_array($wallets));
    }
}