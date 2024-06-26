<?php

namespace Ocebot\KujiraTrack\App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ocebot\KujiraTrack\App\Repository\UskMintedRepository;

#[ORM\Entity(repositoryClass: UskMintedRepository::class)]
class UskMinted
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $num = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $collateral = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $tracked = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?float
    {
        return $this->num;
    }

    public function setNum(float $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getCollateral(): ?string
    {
        return $this->collateral;
    }

    public function setCollateral(string $collateral): self
    {
        $this->collateral = $collateral;

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
