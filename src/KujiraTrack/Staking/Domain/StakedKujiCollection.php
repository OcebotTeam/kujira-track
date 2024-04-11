<?php

namespace Ocebot\KujiraTrack\Staking\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class StakedKujiCollection extends Collection
{
  public function type(): string
  {
    return StakedKuji::class;
  }
}
