<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeaderRepository")
 */
class Leader
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ppsps", inversedBy="leaders")
     */
    private $ppsps;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPpsps(): ?Ppsps
    {
        return $this->ppsps;
    }

    public function setPpsps(?Ppsps $ppsps): self
    {
        $this->ppsps = $ppsps;

        return $this;
    }
}
