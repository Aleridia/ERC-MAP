<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GenreElt
 *
 * @ORM\Table(name="genre_elt")
 * @ORM\Entity
 */
class GenreElt
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_genre", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="genre_elt_id_genre_seq", allocationSize=1, initialValue=1)
     */
    private $idGenre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    public function getIdGenre(): ?int
    {
        return $this->idGenre;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }


}
