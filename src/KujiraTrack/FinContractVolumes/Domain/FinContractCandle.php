<?php

namespace Ocebot\KujiraTrack\FinContractVolumes\Domain;

use DateTime;

class FinContractCandle
{
    public function __construct(
        public readonly float $low,
        public readonly float $high,
        public readonly float $close,
        public readonly float $open,
        public readonly DateTime $time,
        public readonly int $volume,
    )
    {}
}