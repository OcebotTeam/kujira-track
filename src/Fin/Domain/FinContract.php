<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

final class FinContract extends AggregateRoot
{
    private readonly FinContractAddress $address;
    private readonly FinContractTickerId $tickerId;

    public function __construct(
        string $address,
        string $tickerId,
        private readonly int $volumePrecision,
        private readonly int $pricePrecision,
        private readonly ?string $nominative,
        private readonly string $type
    ) {
        $this->address = new FinContractAddress($address);
        $this->tickerId = new FinContractTickerId($tickerId);
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

    public function volumePrecision(): ?int
    {
        return $this->volumePrecision;
    }

    public function pricePrecision(): ?int
    {
        return $this->pricePrecision;
    }

    public function hasNominative(): bool
    {
        return !is_null($this->nominative);
    }

    public function type(): string
    {
        return $this->type;
    }
}
