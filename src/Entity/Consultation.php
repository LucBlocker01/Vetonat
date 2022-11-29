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

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateConsultation = null;

    #[ORM\Column(length: 255)]
    private ?string $motifConsultation = null;

    #[ORM\Column]
    private ?bool $clinique = null;

    #[ORM\Column]
    private ?bool $urgente = null;

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

    public function getDateConsultation(): ?\DateTime
    {
        return $this->dateConsultation;
    }

    public function setDateConsultation(\DateTime $dateConsultation): self
    {
        $this->dateConsultation = $dateConsultation;

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
}
