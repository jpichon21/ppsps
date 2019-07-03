<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubcontractedWorkRepository")
 */
class SubcontractedWork
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
    private $subContractor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subcontractedActivity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ppsps", inversedBy="subcontractedWorks")
     */
    private $ppsps;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubContractor(): ?string
    {
        return $this->subContractor;
    }

    public function setSubContractor(?string $subContractor): self
    {
        $this->subContractor = $subContractor;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getSubcontractedActivity(): ?string
    {
        return $this->subcontractedActivity;
    }

    public function setSubcontractedActivity(?string $subcontractedActivity): self
    {
        $this->subcontractedActivity = $subcontractedActivity;

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
