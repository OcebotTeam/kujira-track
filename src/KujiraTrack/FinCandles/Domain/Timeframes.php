<?php

namespace Ocebot\KujiraTrack\FinCandles\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class Timeframes extends Collection
 {
     protected function type(): string
     {
         return TimeFrame::class;
     }
 }