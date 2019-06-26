<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConfigRepository")
 */
class Config
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $situation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSituation()
    {
        return $this->situation;
    }

    public function setSituation($situation): self
    {
        $this->situation = $situation;

        return $this;
    }
}
