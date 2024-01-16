<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;


use DateTimeImmutable;

class FinContractCandleDateTime
{
    private readonly DateTimeImmutable $date;

    public function __construct(string $date)
    {
        $this->date = new DateTimeImmutable($date);
    }

    public function value(): string
    {
        return $this->date->format('Y-m-d\TH:i:s.uZ');
    }
}