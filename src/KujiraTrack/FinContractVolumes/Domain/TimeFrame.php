<?php

namespace Ocebot\KujiraTrack\FinContractVolumes\Domain;


final class TimeFrame
{
    const TIMEFRAMES = [
        "day1" => [],
        "month1" => []
    ];

    private readonly string $key;

    public function __construct(string $key)
    {
        $this->checkIfSupported($key);
        $this->key = $key;
    }

    public function key()
    {
        return $this->key;
    }

    private function checkIfSupported(string $timeframeKey): void
    {
        if (!in_array($timeframeKey, self::TIMEFRAMES)) {
            throw new TimeFrameNotSupported($timeframeKey);
        }
    }
}