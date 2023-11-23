<?php

namespace App\Entity;

use App\Repository\StakedMantaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StakedMantaRepository::class)]
class StakedManta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $bonded = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $tracked = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBonded(): ?float
    {
        return $this->bonded;
    }

    public function setBonded(float $bonded): self
    {
        $this->bonded = $bonded;

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
