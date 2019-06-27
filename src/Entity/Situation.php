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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descr;

    /**
    * @ORM\OneToMany(targetEntity="Risk", mappedBy="situation", orphanRemoval=true)
    */
    private $risks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tool", mappedBy="situation")
     */
    private $tools;

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
}
