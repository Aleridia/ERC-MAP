<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nature
 *
 * @ORM\Table(name="nature")
 * @ORM\Entity
 */
class Nature
{
    use Traits\TranslatedName;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
