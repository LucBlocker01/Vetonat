<?php

namespace App\Entity;

use App\Repository\CliniqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CliniqueRepository::class)]
class Clinique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adrClinique = null;

    #[ORM\Column(length: 5, nullable: true)]
    private ?string $CPClinique = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $villeClinique = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $telClinique = null;

    #[ORM\Column(length: 255)]
    private ?string $nomClinique = null;

    #[ORM\OneToMany(mappedBy: 'clinique', targetEntity: Veterinaire::class)]
    private Collection $veterinaire;

    public function __construct()
    {
        $this->veterinaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdrClinique(): ?string
    {
        return $this->adrClinique;
    }

    public function setAdrClinique(?string $adrClinique): self
    {
        $this->adrClinique = $adrClinique;

        return $this;
    }

    public function getCPClinique(): ?string
    {
        return $this->CPClinique;
    }

    public function setCPClinique(?string $CPClinique): self
    {
        $this->CPClinique = $CPClinique;

        return $this;
    }

    public function getVilleClinique(): ?string
    {
        return $this->villeClinique;
    }

    public function setVilleClinique(?string $villeClinique): self
    {
        $this->villeClinique = $villeClinique;

        return $this;
    }

    public function getTelClinique(): ?string
    {
        return $this->telClinique;
    }

    public function setTelClinique(?string $telClinique): self
    {
        $this->telClinique = $telClinique;

        return $this;
    }

    public function getNomClinique(): ?string
    {
        return $this->nomClinique;
    }

    public function setNomClinique(string $nomClinique): self
    {
        $this->nomClinique = $nomClinique;

        return $this;
    }

    /**
     * @return Collection<int, Veterinaire>
     */
    public function getVeterinaire(): Collection
    {
        return $this->veterinaire;
    }

    public function addVeterinaire(Veterinaire $veterinaire): self
    {
        if (!$this->veterinaire->contains($veterinaire)) {
            $this->veterinaire->add($veterinaire);
            $veterinaire->setClinique($this);
        }

        return $this;
    }

    public function removeVeterinaire(Veterinaire $veterinaire): self
    {
        if ($this->veterinaire->removeElement($veterinaire)) {
            // set the owning side to null (unless already changed)
            if ($veterinaire->getClinique() === $this) {
                $veterinaire->setClinique(null);
            }
        }

        return $this;
    }
}
