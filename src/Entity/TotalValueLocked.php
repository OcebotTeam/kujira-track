<?php

namespace App\Entity;

use App\Repository\TotalValueLockedRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TotalValueLockedRepository::class)]
class TotalValueLocked
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pair = null;

    #[ORM\Column(length: 255)]
    private ?string $denom = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $tracked = null;

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

    public function getDenom(): ?string
    {
        return $this->denom;
    }

    public function setDenom(string $denom): self
    {
        $this->denom = $denom;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getTracked(): ?\DateTimeInterface
    {
        return $this->tracked;
    }

    public function setTracked(\DateTimeInterface $tracked): self
    {
        $this->tracked = $tracked;

        return $this;
    }
}
