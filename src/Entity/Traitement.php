<?php

namespace App\Entity;

use App\Repository\TraitementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraitementRepository::class)]
class Traitement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descTrait = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $medicament = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $alimentation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescTrait(): ?string
    {
        return $this->descTrait;
    }

    public function setDescTrait(?string $descTrait): self
    {
        $this->descTrait = $descTrait;

        return $this;
    }

    public function getMedicament(): ?string
    {
        return $this->medicament;
    }

    public function setMedicament(?string $medicament): self
    {
        $this->medicament = $medicament;

        return $this;
    }

    public function getAlimentation(): ?string
    {
        return $this->alimentation;
    }

    public function setAlimentation(?string $alimentation): self
    {
        $this->alimentation = $alimentation;

        return $this;
    }
}
