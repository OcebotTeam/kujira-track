<?php

namespace Ocebot\KujiraTrack\App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ocebot\KujiraTrack\App\Repository\BowTvlRepository;

#[ORM\Entity(repositoryClass: BowTvlRepository::class)]
class BowTvl
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pair = null;

    #[ORM\Column(length: 255)]
    private ?string $token = null;

    #[ORM\Column(type: Types::STRING, length: 50)]
    private ?string $balance = null;


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

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getBalance(): ?string
    {
        return $this->balance;
    }

    public function setBalance(string $balance): self
    {
        $this->balance = $balance;

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
