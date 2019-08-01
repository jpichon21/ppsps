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
     * @ORM\ManyToOne(targetEntity="Situation", inversedBy="risks")
     * @ORM\JoinColumn(name="situation_id", referencedColumnName="id", nullable=true)
    */
    private $situation;

    /**
    * @ORM\OneToMany(targetEntity="Measure", mappedBy="risk", orphanRemoval=true)
    */
    private $measures;

    /**
     * @var datetime $deletedAt
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    private $numSituation;

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
        $this->measures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

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
        if (!$this->measures->contains($measures)) {
            $this->measures[] = $measures;
            $measures->setRisk($this);
        }

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

        /**
     * Set deletedAt
     *
     * @param  \DateTime $deletedAt
     * @return Plan
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
        return $this;
    }
    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function getNumSituation(): ?int
    {
        return $this->numSituation;
    }

    public function setNumSituation(?int $numSituation): self
    {
        $this->numSituation = $numSituation;

        return $this;
    }
}
