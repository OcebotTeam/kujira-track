<?php

namespace Ocebot\KujiraTrack\Shared\Domain;

use DateTimeImmutable;

class DateTime
{
    private readonly DateTimeImmutable $date;

    public function __construct(string $date)
    {
        $this->date = new DateTimeImmutable($date);
    }

    public function value(): string
    {
        return $this->date->format('Y-m-d\T00:00:00.000\Z');
    }

    public function unix(): string
    {
        return $this->date->format('U');
    }
}
