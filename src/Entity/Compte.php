<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CompteRepository")
 */
class Compte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint")
     */
    private $solde;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NumeroDeCompte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Prestataire", inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $prest;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sys;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="Compte")
     */
    private $depots;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="Compte")
     */
    private $users;

    public function __construct()
    {
        $this->depots = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getNumeroDeCompte(): ?string
    {
        return $this->NumeroDeCompte;
    }

    public function setNumeroDeCompte(string $NumeroDeCompte): self
    {
        $this->NumeroDeCompte = $NumeroDeCompte;

        return $this;
    }

    public function getPrest(): ?Prestataire
    {
        return $this->prest;
    }

    public function setPrest(?Prestataire $prest): self
    {
        $this->prest = $prest;

        return $this;
    }

    public function getSys(): ?User
    {
        return $this->sys;
    }

    public function setSys(?User $sys): self
    {
        $this->sys = $sys;

        return $this;
    }

    /**
     * @return Collection|Depot[]
     */
    public function getDepots(): Collection
    {
        return $this->depots;
    }

    public function addDepot(Depot $depot): self
    {
        if (!$this->depots->contains($depot)) {
            $this->depots[] = $depot;
            $depot->setCompte($this);
        }

        return $this;
    }

    public function removeDepot(Depot $depot): self
    {
        if ($this->depots->contains($depot)) {
            $this->depots->removeElement($depot);
            // set the owning side to null (unless already changed)
            if ($depot->getCompte() === $this) {
                $depot->setCompte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCompte($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCompte() === $this) {
                $user->setCompte(null);
            }
        }

        return $this;
    }
}
