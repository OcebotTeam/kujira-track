<?php

namespace Ocebot\KujiraTrack\FinContractCharts\Domain;

use Ocebot\KujiraTrack\Shared\Domain\DomainError;

class TimeFrameNotSupportedError extends DomainError
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
        return sprintf('Timeframe with precision <%s> is not supported', $this->timeframeKey);
    }
}
