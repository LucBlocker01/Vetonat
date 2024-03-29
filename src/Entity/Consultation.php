<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $consultationDesc = null;

    #[ORM\Column(length: 255)]
    private ?string $motifConsultation = null;

    #[ORM\Column]
    private ?bool $clinique = null;

    #[ORM\Column]
    private ?bool $urgente = null;

    #[ORM\ManyToOne(inversedBy: 'consultation')]
    private ?Animal $animal = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    private ?Traitement $traitement = null;

    #[ORM\ManyToOne(inversedBy: 'consultations')]
    private ?Veterinaire $veterinaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end = null;

    #[ORM\Column]
    private ?bool $allday = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $backgroundColor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConsultationDesc(): ?string
    {
        return $this->consultationDesc;
    }

    public function setConsultationDesc(string $consultationDesc): self
    {
        $this->consultationDesc = $consultationDesc;

        return $this;
    }

    public function getMotifConsultation(): ?string
    {
        return $this->motifConsultation;
    }

    public function setMotifConsultation(string $motifConsultation): self
    {
        $this->motifConsultation = $motifConsultation;

        return $this;
    }

    public function isClinique(): ?bool
    {
        return $this->clinique;
    }

    public function setClinique(bool $clinique): self
    {
        $this->clinique = $clinique;

        return $this;
    }

    public function isUrgente(): ?bool
    {
        return $this->urgente;
    }

    public function setUrgente(bool $urgente): self
    {
        $this->urgente = $urgente;

        return $this;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }

    public function getTraitement(): ?Traitement
    {
        return $this->traitement;
    }

    public function setTraitement(?Traitement $traitement): self
    {
        $this->traitement = $traitement;

        return $this;
    }

    public function getVeterinaire(): ?Veterinaire
    {
        return $this->veterinaire;
    }

    public function setVeterinaire(?Veterinaire $veterinaire): self
    {
        $this->veterinaire = $veterinaire;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getAllday(): ?bool
    {
        return $this->allday;
    }

    public function setAllday(bool $allday): self
    {
        $this->allday = $allday;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(?string $backgroundColor): self
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }
}
