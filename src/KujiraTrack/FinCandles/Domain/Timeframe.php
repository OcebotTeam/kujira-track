<?php

namespace Ocebot\KujiraTrack\FinCandles\Domain;

class Timeframe
{
    public function __construct(
        private readonly string $precision,
        private readonly string $apiKey,
        private readonly string $dateTimeKey
    ) {
    }

    public function precision(): string
    {
        return $this->precision;
    }

    public function apiKey(): string
    {
        return $this->apiKey;
    }

    public function dateTimeKey(): string
    {
        return $this->dateTimeKey;
    }

    public function toArray(): array
    {
        return [
            'precision' => $this->precision,
            'apiKey' => $this->apiKey,
            'dateTimeKey' => $this->dateTimeKey,
        ];
    }
}
