<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EffectiveRepository")
 */
class Effective
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
    private $business;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $average;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maximum;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ppsps", inversedBy="effectives")
     */
    private $ppsps;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBusiness(): ?string
    {
        return $this->business;
    }

    public function setBusiness(?string $business): self
    {
        $this->business = $business;

        return $this;
    }

    public function getAverage(): ?int
    {
        return $this->average;
    }

    public function setAverage(?int $average): self
    {
        $this->average = $average;

        return $this;
    }

    public function getMaximum(): ?int
    {
        return $this->maximum;
    }

    public function setMaximum(?int $maximum): self
    {
        $this->maximum = $maximum;

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
