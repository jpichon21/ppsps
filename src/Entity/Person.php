<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
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
    private $company;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ppsps", mappedBy="AQSE")
     */
    private $ppsp;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ppsps", mappedBy="siteManagers")
     * @ORM\JoinTable(name="ppsps_sitemanager")
     */
    private $siteManagerPPSPS;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ppsps", mappedBy="workDirectors")
     */
    private $workDirectorsPPSPS;

    private $function;

    public function __construct()
    {
        $this->ppsp = new ArrayCollection();
        $this->siteManagerPPSPS = new ArrayCollection();
        $this->workDirectorsPPSPS = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

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

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection|Ppsps[]
     */
    public function getPpsp(): Collection
    {
        return $this->ppsp;
    }

    public function addPpsp(Ppsps $ppsp): self
    {
        if (!$this->ppsp->contains($ppsp)) {
            $this->ppsp[] = $ppsp;
            $ppsp->setAQSE($this);
        }

        return $this;
    }

    public function removePpsp(Ppsps $ppsp): self
    {
        if ($this->ppsp->contains($ppsp)) {
            $this->ppsp->removeElement($ppsp);
            // set the owning side to null (unless already changed)
            if ($ppsp->getAQSE() === $this) {
                $ppsp->setAQSE(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ppsps[]
     */
    public function getSiteManagerPPSPS(): Collection
    {
        return $this->siteManagerPPSPS;
    }

    public function addSiteManagerPPSP(Ppsps $siteManagerPPSP): self
    {
        if (!$this->siteManagerPPSPS->contains($siteManagerPPSP)) {
            $this->siteManagerPPSPS[] = $siteManagerPPSP;
            $siteManagerPPSP->addSiteManager($this);
        }

        return $this;
    }

    public function removeSiteManagerPPSP(Ppsps $siteManagerPPSP): self
    {
        if ($this->siteManagerPPSPS->contains($siteManagerPPSP)) {
            $this->siteManagerPPSPS->removeElement($siteManagerPPSP);
            $siteManagerPPSP->removeSiteManager($this);
        }

        return $this;
    }

    /**
     * @return Collection|Ppsps[]
     */
    public function getWorkDirectorsPPSPS(): Collection
    {
        return $this->workDirectorsPPSPS;
    }

    public function addWorkDirectorsPPSP(Ppsps $workDirectorsPPSP): self
    {
        if (!$this->workDirectorsPPSPS->contains($workDirectorsPPSP)) {
            $this->workDirectorsPPSPS[] = $workDirectorsPPSP;
            $workDirectorsPPSP->addWorkDirector($this);
        }

        return $this;
    }

    public function removeWorkDirectorsPPSP(Ppsps $workDirectorsPPSP): self
    {
        if ($this->workDirectorsPPSPS->contains($workDirectorsPPSP)) {
            $this->workDirectorsPPSPS->removeElement($workDirectorsPPSP);
            $workDirectorsPPSP->removeWorkDirector($this);
        }

        return $this;
    }

    public function getFunction(): ?string
    {
        return $this->function;
    }

    public function setFunction(?string $function): self
    {
        $this->function = $function;

        return $this;
    }
}
