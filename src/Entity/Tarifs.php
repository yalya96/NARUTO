<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TarifsRepository")
 */
class Tarifs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $BorneInferieure;

    /**
     * @ORM\Column(type="integer")
     */
    private $BorneSuperieure;

    /**
     * @ORM\Column(type="integer")
     */
    private $Valeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorneInferieure(): ?int
    {
        return $this->BorneInferieure;
    }

    public function setBorneInferieure(int $BorneInferieure): self
    {
        $this->BorneInferieure = $BorneInferieure;

        return $this;
    }

    public function getBorneSuperieure(): ?int
    {
        return $this->BorneSuperieure;
    }

    public function setBorneSuperieure(int $BorneSuperieure): self
    {
        $this->BorneSuperieure = $BorneSuperieure;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->Valeur;
    }

    public function setValeur(int $Valeur): self
    {
        $this->Valeur = $Valeur;

        return $this;
    }
}
