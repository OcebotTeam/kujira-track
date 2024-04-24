<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

class Timeframe
{
    public function __construct(
        private readonly string $precision,
        private readonly string $apiKey,
        private readonly string $dateTimeKey,
        private readonly string $format
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

    public function format(): string
    {
        return $this->format;
    }
}
