<?php

namespace Ocebot\KujiraTrack\App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ocebot\KujiraTrack\App\Repository\TokenRepository;

#[ORM\Entity(repositoryClass: TokenRepository::class)]
class Token
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $base_currency = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $target_currency = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $ticker_id = null;

    #[ORM\Column]
    private ?float $ask = null;

    #[ORM\Column]
    private ?float $bid = null;

    #[ORM\Column]
    private ?float $high = null;

    #[ORM\Column]
    private ?float $low = null;

    #[ORM\Column]
    private ?float $base_volume = null;

    #[ORM\Column]
    private ?float $target_volume = null;

    #[ORM\Column]
    private ?float $last_price = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $pool_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $tracked = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBaseCurrency(): ?string
    {
        return $this->base_currency;
    }

    public function setBaseCurrency(string $base_currency): self
    {
        $this->base_currency = $base_currency;

        return $this;
    }

    public function getTargetCurrency(): ?string
    {
        return $this->target_currency;
    }

    public function setTargetCurrency(string $target_currency): self
    {
        $this->target_currency = $target_currency;

        return $this;
    }

    public function getTickerId(): ?string
    {
        return $this->ticker_id;
    }

    public function setTickerId(string $ticker_id): self
    {
        $this->ticker_id = $ticker_id;

        return $this;
    }

    public function getAsk(): ?float
    {
        return $this->ask;
    }

    public function setAsk(float $ask): self
    {
        $this->ask = $ask;

        return $this;
    }

    public function getBid(): ?float
    {
        return $this->bid;
    }

    public function setBid(float $bid): self
    {
        $this->bid = $bid;

        return $this;
    }

    public function getHigh(): ?float
    {
        return $this->high;
    }

    public function setHigh(float $high): self
    {
        $this->high = $high;

        return $this;
    }

    public function getLow(): ?float
    {
        return $this->low;
    }

    public function setLow(float $low): self
    {
        $this->low = $low;

        return $this;
    }

    public function getBaseVolume(): ?float
    {
        return $this->base_volume;
    }

    public function setBaseVolume(float $base_volume): self
    {
        $this->base_volume = $base_volume;

        return $this;
    }

    public function getTargetVolume(): ?float
    {
        return $this->target_volume;
    }

    public function setTargetVolume(float $target_volume): self
    {
        $this->target_volume = $target_volume;

        return $this;
    }

    public function getLastPrice(): ?float
    {
        return $this->last_price;
    }

    public function setLastPrice(float $last_price): self
    {
        $this->last_price = $last_price;

        return $this;
    }

    public function getPoolId(): ?string
    {
        return $this->pool_id;
    }

    public function setPoolId(string $pool_id): self
    {
        $this->pool_id = $pool_id;

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
