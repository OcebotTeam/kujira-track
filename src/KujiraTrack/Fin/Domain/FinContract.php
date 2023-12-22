<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

use Ocebot\KujiraTrack\Shared\Domain\Aggregate\AggregateRoot;

final class FinContract extends AggregateRoot
{
    public function __construct(
        private readonly string $contract,
        private readonly FinContractTickerId $tickerId,
        private readonly ?string $nominative,
        private readonly ?int $decimals
    ) {
    }

    public function contract(): string
    {
        return $this->contract;
    }

    public function tickerId(): FinContractTickerId
    {
        return $this->tickerId;
    }

    public function nominative(): ?string
    {
        return $this->nominative;
    }

    public function decimals(): ?int
    {
        return $this->decimals;
    }
}
