<?php

namespace Ocebot\KujiraTrack\FinContractVolumes\Domain;

use Ocebot\KujiraTrack\FinContracts\Domain\FinContractTickerId;
use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

final class FinContractVolume extends AggregateRoot
{
    private readonly FinContractTickerId $tickerId;
    private readonly TimeFrame $timeframe;

    public function __construct(string $tickerId, string $timeFrame)
    {
        $this->tickerId = new FinContractTickerId($tickerId);
        $this->timeframe = new TimeFrame($timeFrame);
    }
}