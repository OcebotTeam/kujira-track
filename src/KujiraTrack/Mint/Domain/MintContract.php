<?php

namespace Ocebot\KujiraTrack\Mint\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

class MintContract extends AggregateRoot
{
    private readonly string $collateral;
    private readonly string $address;
    private readonly bool $margin;

    public function __construct(string $collateral, string $address, ?bool $margin)
    {
        $this->collateral = $collateral;
        $this->address = $address;
        $this->margin = $margin;
    }

    public function collateral(): string
    {
        return $this->collateral;
    }
    public function address(): string
    {
        return $this->address;
    }
    public function isMargin()
    {
        return $this->margin;
    }
}
