<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomPers = null;

    #[ORM\Column(length: 255)]
    private ?string $pnomPers = null;

    #[ORM\Column(length: 255)]
    private ?string $villePers = null;

    #[ORM\Column(length: 255)]
    private ?string $CPPers = null;

    #[ORM\Column(length: 255)]
    private ?string $telPers = null;

    #[ORM\Column(length: 255)]
    private ?string $loginPers = null;

    #[ORM\Column(length: 255)]
    private ?string $mdpPers = null;

    #[ORM\Column(length: 255)]
    private ?string $adrPers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPers(): ?string
    {
        return $this->nomPers;
    }

    public function setNomPers(string $nomPers): self
    {
        $this->nomPers = $nomPers;

        return $this;
    }

    public function getPnomPers(): ?string
    {
        return $this->pnomPers;
    }

    public function setPnomPers(string $pnomPers): self
    {
        $this->pnomPers = $pnomPers;

        return $this;
    }

    public function getVillePers(): ?string
    {
        return $this->villePers;
    }

    public function setVillePers(string $villePers): self
    {
        $this->villePers = $villePers;

        return $this;
    }

    public function getCPPers(): ?string
    {
        return $this->CPPers;
    }

    public function setCPPers(string $CPPers): self
    {
        $this->CPPers = $CPPers;

        return $this;
    }

    public function getTelPers(): ?string
    {
        return $this->telPers;
    }

    public function setTelPers(string $telPers): self
    {
        $this->telPers = $telPers;

        return $this;
    }

    public function getLoginPers(): ?string
    {
        return $this->loginPers;
    }

    public function setLoginPers(string $loginPers): self
    {
        $this->loginPers = $loginPers;

        return $this;
    }

    public function getMdpPers(): ?string
    {
        return $this->mdpPers;
    }

    public function setMdpPers(string $mdpPers): self
    {
        $this->mdpPers = $mdpPers;

        return $this;
    }

    public function getAdrPers(): ?string
    {
        return $this->adrPers;
    }

    public function setAdrPers(string $adrPers): self
    {
        $this->adrPers = $adrPers;

        return $this;
    }
}
