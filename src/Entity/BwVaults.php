<?php

namespace App\Entity;

use App\Repository\BwVaultsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BwVaultsRepository::class)]
class BwVaults
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pair = null;

    #[ORM\Column(length: 255)]
    private ?string $vault_address = null;

    #[ORM\Column(length: 255)]
    private ?string $performance = null;

    #[ORM\Column(length: 255)]
    private ?string $profit_in_usdc = null;

    #[ORM\Column(length: 255)]
    private ?string $liquidity = null;

    #[ORM\Column(length: 255)]
    private ?string $base_denom = null;

    #[ORM\Column(length: 255)]
    private ?string $quote_denom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $tracked = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPair(): ?string
    {
        return $this->pair;
    }

    public function setPair(string $pair): self
    {
        $this->pair = $pair;

        return $this;
    }

    public function getVaultAddress(): ?string
    {
        return $this->vault_address;
    }

    public function setVaultAddress(string $vault_address): self
    {
        $this->vault_address = $vault_address;

        return $this;
    }

    public function getPerformance(): ?string
    {
        return $this->performance;
    }

    public function setPerformance(string $performance): self
    {
        $this->performance = $performance;

        return $this;
    }

    public function getProfitInUsdc(): ?string
    {
        return $this->profit_in_usdc;
    }

    public function setProfitInUsdc(string $profit_in_usdc): self
    {
        $this->profit_in_usdc = $profit_in_usdc;

        return $this;
    }

    public function getLiquidity(): ?string
    {
        return $this->liquidity;
    }

    public function setLiquidity(string $liquidity): self
    {
        $this->liquidity = $liquidity;

        return $this;
    }

    public function getBaseDenom(): ?string
    {
        return $this->base_denom;
    }

    public function setBaseDenom(string $base_denom): self
    {
        $this->base_denom = $base_denom;

        return $this;
    }

    public function getQuoteDenom(): ?string
    {
        return $this->quote_denom;
    }

    public function setQuoteDenom(string $quote_denom): self
    {
        $this->quote_denom = $quote_denom;

        return $this;
    }

    public function getTracked(): ?\DateTime
    {
        return $this->tracked;
    }

    public function setTracked(\DateTime $tracked): self
    {
        $this->tracked = $tracked;

        return $this;
    }
}
