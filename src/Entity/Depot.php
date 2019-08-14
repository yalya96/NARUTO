<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DepotRepository")
 */
class Depot
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
    private $Montant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateDeDepot;

    /**
     * @ORM\Column(type="bigint")
     */
    private $SoldeInitial;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="depots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Caissier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="depots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Compte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?int
    {
        return $this->Montant;
    }

    public function setMontant(int $Montant): self
    {
        $this->Montant = $Montant;

        return $this;
    }

    public function getDateDeDepot(): ?\DateTimeInterface
    {
        return $this->DateDeDepot;
    }

    public function setDateDeDepot(\DateTimeInterface $DateDeDepot): self
    {
        $this->DateDeDepot = $DateDeDepot;

        return $this;
    }

    public function getSoldeInitial(): ?int
    {
        return $this->SoldeInitial;
    }

    public function setSoldeInitial(int $SoldeInitial): self
    {
        $this->SoldeInitial = $SoldeInitial;

        return $this;
    }

    public function getCaissier(): ?User
    {
        return $this->Caissier;
    }

    public function setCaissier(?User $Caissier): self
    {
        $this->Caissier = $Caissier;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->Compte;
    }

    public function setCompte(?Compte $Compte): self
    {
        $this->Compte = $Compte;

        return $this;
    }
}
