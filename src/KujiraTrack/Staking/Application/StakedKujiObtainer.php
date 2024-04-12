<?php

namespace Ocebot\KujiraTrack\Staking\Application;

use Ocebot\KujiraTrack\Staking\Domain\StakedKuji;
use Ocebot\KujiraTrack\Staking\Domain\StakedKujiRepository;

class StakedKujiObtainer
{
    public function __construct(
      private readonly StakedKujiRepository $stakedKujiRepository
    ) {
    }

    public function __invoke(): array {
      $stakedKuji = $this->stakedKujiRepository->get();

      return array_map(function (StakedKuji $stakedKuji) {

        return [
          'time' => $stakedKuji->time(),
          'value' => $stakedKuji->bondedTokens()
        ];
      }, iterator_to_array($stakedKuji));
    }
}