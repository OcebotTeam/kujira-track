<?php

namespace Ocebot\KujiraTrack\App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ocebot\KujiraTrack\App\Repository\LockedMantaRepository;

#[ORM\Entity(repositoryClass: LockedMantaRepository::class)]
class LockedManta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $locked = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $tracked = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocked(): ?float
    {
        return $this->locked;
    }

    public function setLocked(float $locked): self
    {
        $this->locked = $locked;

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
