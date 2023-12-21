<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

final class FinContract
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
