<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

final class FinContract extends AggregateRoot
{
    private readonly FinContractAddress $address;
    private readonly FinContractTickerId $tickerId;
    private readonly int $volumeDivider;
    private readonly int $priceDivider;
    private readonly ?string $nominative;

    public function __construct(string $address, string $tickerId, int $volumeDivider, int $priceDivider, ?string $nominative)
    {
        $this->address = new FinContractAddress($address);
        $this->tickerId = new FinContractTickerId($tickerId);
        $this->nominative = $nominative;
        $this->volumeDivider = $volumeDivider;
        $this->priceDivider = $priceDivider;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function tickerId(): string
    {
        return $this->tickerId->value();
    }

    public function nominative(): ?string
    {
        return $this->nominative;
    }

    public function volumeDivider(): ?int
    {
        return $this->volumeDivider;
    }

    public function priceDivider(): ?int
    {
        return $this->priceDivider;
    }

    public function hasNominative(): bool
    {
        return !is_null($this->nominative);
    }
}
