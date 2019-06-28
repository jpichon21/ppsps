<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RiskRepository")
 */
class Risk
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
     * @ORM\ManyToOne(targetEntity="Situation", inversedBy="risks")
     * @ORM\JoinColumn(name="situation_id", referencedColumnName="id", nullable=false)
    */
    private $situation;

    /**
    * @ORM\OneToMany(targetEntity="Measure", mappedBy="risk", orphanRemoval=true)
    */
    private $measures;

    /**
     * to string method
     *
     * @return string
    */
    public function __toString()
    {
        return $this->getName().' - '.$this->situation->getName();
    }

    /**
     * Constructor
    */
    public function __construct()
    {
        $this->measures = new ArrayCollection();
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
     * Get situation
     *
     * @return Collection
     */
    public function getSituation()
    {
        return $this->situation;
    }

    public function setSituation($situation)
    {
        $this->situation = $situation;

        return $this;
    }

    /**
     * Get measures
     *
     * @return Collection
     */
    public function getMeasures()
    {
        return $this->measures;
    }

    /**
     * Add measures
     *
     * @param Measure $measures
     *
     * @return Category
     */
    public function addMeasures($measures)
    {
        $this->measures[] = $measures;

        return $this;
    }

    /**
     * Remove measures
     *
     * @param Measure $measures
     */
    public function removeMeasures($measures)
    {
        $this->measures->removeElement($measures);
    }
}
