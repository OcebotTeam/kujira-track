<?php

namespace Ocebot\KujiraTrack\FinContracts\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

final class FinContract extends AggregateRoot
{
    private readonly string $contract;
    private readonly FinContractTickerId $tickerId;
    private readonly int $decimals;
    private readonly ?string $nominative;

    public function __construct(string $contract, string $tickerId, int $decimals, ?string $nominative)
    {
        $this->contract = $contract;
        $this->tickerId = new FinContractTickerId($tickerId);
        $this->nominative = $nominative;
        $this->decimals = $decimals;
    }

    public function contract(): string
    {
        return $this->contract;
    }

    public function tickerId(): string
    {
        return $this->tickerId->value();
    }

    public function nominative(): ?string
    {
        return $this->nominative;
    }

    public function decimals(): ?int
    {
        return $this->decimals;
    }

    public function hasNominative()
    {
        return !is_null($this->nominative);
    }
}
