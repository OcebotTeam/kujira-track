<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Collection;

class TimeframeCollection extends Collection
{
    protected function type(): string
    {
        return TimeFrame::class;
    }
}
