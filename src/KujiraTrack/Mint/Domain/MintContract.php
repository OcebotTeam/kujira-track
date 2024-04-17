<?php

namespace Ocebot\KujiraTrack\Mint\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

class MintContract extends AggregateRoot
{
    private readonly string $collateral;
    private readonly string $contract;
    private readonly bool $margin;

    public function __construct(string $collateral, string $contract, ?bool $margin)
    {
        $this->collateral = $collateral;
        $this->contract = $contract;
        $this->margin = $margin;
    }

    public function collateral(): string
    {
        return $this->collateral;
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
