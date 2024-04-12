<?php

namespace Ocebot\KujiraTrack\Shared\Domain;

use DateTimeImmutable;

class KtDateTime
{
    private readonly DateTimeImmutable $date;

    public function __construct(string $date)
    {
        // Check if the date is timestamp
        if (is_numeric($date)) {
            $this->date = new DateTimeImmutable('@' . $date);
            return;
        }

        $this->date = new DateTimeImmutable($date);
    }

    public function dateValue(): string
    {
        return $this->date->format('Y-m-d\T00:00:00.000\Z');
    }

    public function dateTimeValue(): string
    {
        return $this->date->format('Y-m-d\TH:i:s.u\Z');
    }

    public function unix(): string
    {
        return $this->date->format('U');
    }
}
