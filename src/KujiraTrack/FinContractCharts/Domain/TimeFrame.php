<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;


final class TimeFrame
{
    const VALID_PRECISION = [
        "day1" => "1D",
        "month1" => "1M"
    ];

    private readonly string $precision;

    public function __construct(string $key)
    {
        $this->checkIfSupported($key);
        $this->precision = $key;
    }

    public function precision(): string
    {
        return self::VALID_PRECISION[$this->precision];
    }

    private function checkIfSupported(string $timeframeKey): void
    {
        if (!in_array($timeframeKey, array_keys(self::VALID_PRECISION))) {
            throw new TimeFrameNotSupportedError($timeframeKey);
        }
    }
}