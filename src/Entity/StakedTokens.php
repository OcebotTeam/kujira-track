<?php

namespace App\Entity;

use App\Repository\StakedTokensRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StakedTokensRepository::class)]
class StakedTokens
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $not_bonded_tokens = null;

    #[ORM\Column]
    private ?float $bonded_tokens = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $tracked = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotBondedTokens(): ?float
    {
        return $this->not_bonded_tokens;
    }

    public function setNotBondedTokens(float $not_bonded_tokens): self
    {
        $this->not_bonded_tokens = $not_bonded_tokens;

        return $this;
    }

    public function getBondedTokens(): ?float
    {
        return $this->bonded_tokens;
    }

    public function setBondedTokens(float $bonded_tokens): self
    {
        $this->bonded_tokens = $bonded_tokens;

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
