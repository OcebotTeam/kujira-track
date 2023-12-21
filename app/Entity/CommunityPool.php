<?php

namespace App\Entity;

use App\Repository\CommunityPoolRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommunityPoolRepository::class)]
class CommunityPool
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $denom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $token = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $tracked = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

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
