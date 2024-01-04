<?php

namespace Ocebot\KujiraTrack\FinContractVolumes\Domain;

use Ocebot\KujiraTrack\Shared\Domain\DomainError;

class TimeFrameNotSupported extends DomainError
{

    public function __construct(private readonly string $timeframeKey)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'timeframe_not_supported';
    }

    protected function errorMessage(): string
    {
        return sprintf('Timeframe with key <%s> is not supported', $this->timeframeKey);
    }
}