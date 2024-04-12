<?php

namespace Ocebot\KujiraTrack\UskCollaterals\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

class UskCollateral extends AggregateRoot
{
    private readonly string $token;
    private readonly string $contract;
    private readonly bool $margin;

    public function __construct(string $token, string $contract, ?bool $margin)
    {
        $this->token = $token;
        $this->contract = $contract;
        $this->margin = $margin;
    }

    public function token(): string
    {
        return $this->token;
    }
    public function contract(): string
    {
        return $this->contract;
    }
    public function isMargin()
    {
        return $this->margin;
    }
}
