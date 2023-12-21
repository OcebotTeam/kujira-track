<?php

namespace Ocebot\KujiraTrack\Fin\Domain;

final class FinContract
{
    public function __construct(
        private readonly string $contract,
        private readonly string $tickerId,
        private readonly ?string $nominative,
        private readonly ?int $decimals
    ) {
    }

    public function getContract(): string
    {
        return $this->contract;
    }

    public function getTickerId(): string
    {
        return $this->tickerId;
    }

    public function getNominative(): ?string
    {
        return $this->nominative;
    }

    public function getDecimals(): ?int
    {
        return $this->decimals;
    }
}
