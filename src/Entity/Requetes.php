<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RequetesRepository")
 */
class Requetes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $req_lib;

    /**
     * @ORM\Column(type="text")
     */
    private $req_corps;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\chercheur", inversedBy="requetes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_chercheur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReqLib(): ?string
    {
        return $this->req_lib;
    }

    public function setReqLib(string $req_lib): self
    {
        $this->req_lib = $req_lib;

        return $this;
    }

    public function getReqCorps(): ?string
    {
        return $this->req_corps;
    }

    public function setReqCorps(string $req_corps): self
    {
        $this->req_corps = $req_corps;

        return $this;
    }

    public function getIdChercheur(): ?chercheur
    {
        return $this->id_chercheur;
    }

    public function setIdChercheur(?chercheur $id_chercheur): self
    {
        $this->id_chercheur = $id_chercheur;

        return $this;
    }
}
