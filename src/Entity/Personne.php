<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method string getUserIdentifier()
 */
#[ORM\Entity(repositoryClass: PersonneRepository::class)]
class Personne implements UserInterface,PasswordAuthenticatedUserInterface
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

    #[ORM\Column]
    private array $roles = [];

    #[ORM\OneToOne(mappedBy: 'personne', cascade: ['persist', 'remove'])]
    private ?Client $client = null;

    #[ORM\OneToOne(mappedBy: 'personne', cascade: ['persist', 'remove'])]
    private ?Veterinaire $veterinaire = null;

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(Client $client): self
    {
        // set the owning side of the relation if necessary
        if ($client->getPersonne() !== $this) {
            $client->setPersonne($this);
        }

        $this->client = $client;

        return $this;
    }

    public function getVeterinaire(): ?Veterinaire
    {
        return $this->veterinaire;
    }

    public function setVeterinaire(Veterinaire $veterinaire): self
    {
        // set the owning side of the relation if necessary
        if ($veterinaire->getPersonne() !== $this) {
            $veterinaire->setPersonne($this);
        }

        $this->veterinaire = $veterinaire;

        return $this;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->mdpPers;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername() : string
    {
        return (string) $this->loginPers;
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}
