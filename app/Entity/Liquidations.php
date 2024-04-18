<?php

namespace Ocebot\KujiraTrack\App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ocebot\KujiraTrack\App\Repository\LiquidationsRepository;

#[ORM\Entity(repositoryClass: LiquidationsRepository::class)]
class Liquidations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $liquidation_id = null;

    #[ORM\Column]
    private ?int $timestamp = null;

    #[ORM\Column(length: 255)]
    private ?string $burn_amount = null;

    #[ORM\Column(length: 255)]
    private ?string $contract_address = null;

    #[ORM\Column(length: 255)]
    private ?string $refund_amount = null;

    #[ORM\Column(length: 255)]
    private ?string $liquidate_amount = null;

    #[ORM\Column(length: 255)]
    private ?string $fee_amount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLiquidationId(): ?int
    {
        return $this->liquidation_id;
    }

    public function setLiquidationId(int $liquidation_id): self
    {
        $this->liquidation_id = $liquidation_id;

        return $this;
    }

    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getBurnAmount(): ?string
    {
        return $this->burn_amount;
    }

    public function setBurnAmount(string $burn_amount): self
    {
        $this->burn_amount = $burn_amount;

        return $this;
    }

    public function getContractAddress(): ?string
    {
        return $this->contract_address;
    }

    public function setContractAddress(string $contract_address): self
    {
        $this->contract_address = $contract_address;

        return $this;
    }

    public function getRefundAmount(): ?string
    {
        return $this->refund_amount;
    }

    public function setRefundAmount(string $refund_amount): self
    {
        $this->refund_amount = $refund_amount;

        return $this;
    }

    public function getLiquidateAmount(): ?string
    {
        return $this->liquidate_amount;
    }

    public function setLiquidateAmount(string $liquidate_amount): self
    {
        $this->liquidate_amount = $liquidate_amount;

        return $this;
    }

    public function getFeeAmount(): ?string
    {
        return $this->fee_amount;
    }

    public function setFeeAmount(string $fee_amount): self
    {
        $this->fee_amount = $fee_amount;

        return $this;
    }
}
