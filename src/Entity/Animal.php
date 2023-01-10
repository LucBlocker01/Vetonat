<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?bool $Stereliser = null;

    #[ORM\Column(nullable: true)]
    private ?int $ageAnimal = null;

    #[ORM\Column(nullable: true)]
    private ?float $poidsAnimal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descriptionAnimal = null;

    #[ORM\ManyToOne(inversedBy: 'animal')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: Consultation::class, cascade: ['persist', 'remove'])]
    private Collection $consultation;

    public function __construct()
    {
        $this->consultation = new ArrayCollection();
    }

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

    public function setStereliser(bool $Stereliser): self
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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Consultation>
     */
    public function getConsultation(): Collection
    {
        return $this->consultation;
    }

    public function addConsultation(Consultation $consultation): self
    {
        if (!$this->consultation->contains($consultation)) {
            $this->consultation->add($consultation);
            $consultation->setAnimal($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultation->removeElement($consultation)) {
            // set the owning side to null (unless already changed)
            if ($consultation->getAnimal() === $this) {
                $consultation->setAnimal(null);
            }
        }

        return $this;
    }
}
