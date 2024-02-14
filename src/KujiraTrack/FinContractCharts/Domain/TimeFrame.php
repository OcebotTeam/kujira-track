<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

abstract class TimeFrame
{
    public function __construct(private readonly string $precision)
    {
    }

    public function precision(): string
    {
        return $this->precision;
    }

    abstract public function apiKey(): string;

    abstract public function dateTimeKey(): string;
}
