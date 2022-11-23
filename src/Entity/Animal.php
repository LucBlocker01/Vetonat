<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomAnimal = null;

    #[ORM\Column(length: 255)]
    private ?string $EspeceAnimal = null;

    #[ORM\Column]
    private ?bool $St�ereliser = null;

    #[ORM\Column(nullable: true)]
    private ?int $ageAnimal = null;

    #[ORM\Column(nullable: true)]
    private ?float $poidsAnimal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descriptionAnimal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAnimal(): ?string
    {
        return $this->nomAnimal;
    }

    public function setNomAnimal(string $nomAnimal): self
    {
        $this->nomAnimal = $nomAnimal;

        return $this;
    }

    public function getEspeceAnimal(): ?string
    {
        return $this->EspeceAnimal;
    }

    public function setEspeceAnimal(string $EspeceAnimal): self
    {
        $this->EspeceAnimal = $EspeceAnimal;

        return $this;
    }

    public function isStereliser(): ?bool
    {
        return $this->Stereliser;
    }

    public function setStereliser(bool $Strereliser): self
    {
        $this->Stereliser = $Stereliser;

        return $this;
    }

    public function getAgeAnimal(): ?int
    {
        return $this->ageAnimal;
    }

    public function setAgeAnimal(?int $ageAnimal): self
    {
        $this->ageAnimal = $ageAnimal;

        return $this;
    }

    public function getPoidsAnimal(): ?float
    {
        return $this->poidsAnimal;
    }

    public function setPoidsAnimal(?float $poidsAnimal): self
    {
        $this->poidsAnimal = $poidsAnimal;

        return $this;
    }

    public function getDescriptionAnimal(): ?string
    {
        return $this->descriptionAnimal;
    }

    public function setDescriptionAnimal(?string $descriptionAnimal): self
    {
        $this->descriptionAnimal = $descriptionAnimal;

        return $this;
    }
}
