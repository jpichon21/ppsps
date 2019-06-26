<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeasureRepository")
 */
class Measure
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descr;

    /**
     * @ORM\ManyToOne(targetEntity="Risk", inversedBy="measures")
     * @ORM\JoinColumn(name="risk_id", referencedColumnName="id", nullable=false)
    */
    private $risk;

    /**
     * to string method
     *
     * @return string
    */
    public function __toString()
    {
        return $this->getName();
    }

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

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(?string $descr): self
    {
        $this->descr = $descr;

        return $this;
    }

    /**
     * Get risk
     *
     * @return Collection
     */
    public function getRisk()
    {
        return $this->risk;
    }
    
    public function setRisk($risk)
    {
        $this->risk = $risk;

        return $this;
    }
}
