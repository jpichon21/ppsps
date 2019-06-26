<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SituationRepository")
 */
class Situation
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
    * @ORM\OneToMany(targetEntity="Risk", mappedBy="situation", orphanRemoval=true)
    */
    private $risks;

    /**
     * to string method
     *
     * @return string
    */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Constructor
    */
    public function __construct()
    {
        $this->risks = new ArrayCollection();
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
     * Get risks
     *
     * @return Collection
     */
    public function getRisks()
    {
        return $this->risks;
    }

    /**
     * Add risks
     *
     * @param Risk $risks
     *
     * @return Category
     */
    public function addRisks($risks)
    {
        $this->risks[] = $risks;

        return $this;
    }

    /**
     * Remove risks
     *
     * @param Risk $risks
     */
    public function removeRisks($risks)
    {
        $this->risks->removeElement($risks);
    }
}
