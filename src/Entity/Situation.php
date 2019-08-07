<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
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
    * @ORM\OneToMany(targetEntity="Risk", mappedBy="situation", orphanRemoval=true)
    */
    private $risks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tool", mappedBy="situation")
     */
    private $tools;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SituationGroup", inversedBy="situations")
     */
    private $situationGroup;

    /**
     * @var datetime $deletedAt
     *
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    private $numSituationGroup;

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
        $this->tools = new ArrayCollection();
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
        if (!$this->risks->contains($risks)) {
            $this->risks[] = $risks;
            $risks->setSituation($this);
        }

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

    /**
     * @return Collection|Tool[]
     */
    public function getTools(): Collection
    {
        return $this->tools;
    }

    public function addTool(Tool $tool): self
    {
        if (!$this->tools->contains($tool)) {
            $this->tools[] = $tool;
            $tool->setSituation($this);
        }

        return $this;
    }

    public function removeTool(Tool $tool): self
    {
        if ($this->tools->contains($tool)) {
            $this->tools->removeElement($tool);
            // set the owning side to null (unless already changed)
            if ($tool->getSituation() === $this) {
                $tool->setSituation(null);
            }
        }

        return $this;
    }

    public function getSituationGroup(): ?SituationGroup
    {
        return $this->situationGroup;
    }

    public function setSituationGroup(?SituationGroup $situationGroup): self
    {
        $this->situationGroup = $situationGroup;

        return $this;
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

    public function getNumSituationGroup(): ?int
    {
        return $this->numSituationGroup;
    }

    public function setNumSituationGroup(?int $numSituationGroup): self
    {
        $this->numSituationGroup = $numSituationGroup;

        return $this;
    }
}
