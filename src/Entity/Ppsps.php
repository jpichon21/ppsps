<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PpspsRepository")
 */
class Ppsps
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
    private $AddressConstrSite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AddressAccessSite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referentPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $referentMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descrWork;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subWorkDescr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mandatoryDescr;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateBegin;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $openingSite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $siteNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $globalSiteAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $projectManager;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $periodOfExecution;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Cissct;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Effective", mappedBy="ppsps", cascade={"persist", "remove"})
     */
    private $effectives;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $securityCoordinator;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $PGC;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $inspectionVisit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $securityCoordinatorName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PGCRef;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $PGCDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $inspectionVisitDate;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $listOfInstallations = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $maintainer;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $suiabilityList = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $suiability;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $otherInstalation;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $mandatoryDocument = [];

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $particularSecurityMeasure;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $particularSecurityDetail;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $situation = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Diffusion", mappedBy="ppsps", cascade={"persist", "remove"})
     */
    private $diffusions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Speaker", mappedBy="ppsps", cascade={"persist", "remove"})
     */
    private $speakers;

    /**
     * @ORM\Column(type="boolean", length=255, nullable=true)
     */
    private $myCissct;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UpdatePpsps", mappedBy="ppsps", cascade={"persist", "remove"})
     */
    private $updatesPpsps;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dealer", mappedBy="ppsps", cascade={"persist", "remove"})
     */
    private $dealers;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteLevel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SubcontractedWork", mappedBy="ppsps", cascade={"persist", "remove"})
     */
    private $subcontractedWorks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Annex", mappedBy="ppsps", cascade={"persist", "remove"})
     */
    private $annexs;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $beginStopWork;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endStopWork;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $optionalDICTMessage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isMaintenedByRougeot;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="ppsp")
     */
    private $AQSE;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupment", inversedBy="ppsps")
     * @ORM\JoinColumn(name="groupment_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $groupment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isControlled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isGuardian;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PpspsImage", inversedBy="ppsps")
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstWorkConductor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $editor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $projectDirector;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $approbator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secondApprobator;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $listOfWorksMandatoryDocs = [];

    /**
     * @ORM\Column(type="boolean")
     */
    private $particularExternalRisk;

    /**
     * @ORM\Column(type="boolean")
     */
    private $annexSubworkers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Person", inversedBy="siteManagerPPSPS")
     * @ORM\JoinTable(name="ppsps_sitemanager",
     *      joinColumns={@ORM\JoinColumn(name="ppsps_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id", onDelete="CASCADE")})
     */
    private $siteManagers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Person", inversedBy="workDirectorsPPSPS")
     * @ORM\JoinTable(name="ppsps_workdirector",
     *      joinColumns={@ORM\JoinColumn(name="ppsps_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id", onDelete="CASCADE")})
     */
    private $workDirectors;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $MondayMorning;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $MondayAfternoon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tuesdayMorning;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tuesdayAfternoon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wednesdayMorning;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wednesdayAfternoon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thursdayMorning;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thursdayAfternoon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fridayMorning;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fridayAfternoon;

    /**
     * to string method
     *
     * @return string
    */
    public function __toString()
    {
        return $this->getSiteName().' - '.$this->getSiteNumber();
    }

    /**
     * Constructor
    */
    public function __construct()
    {
        $this->speaker = new ArrayCollection();
        $this->effectives = new ArrayCollection();
        $this->diffusions = new ArrayCollection();
        $this->speakers = new ArrayCollection();
        $this->updatesPpsps = new ArrayCollection();
        $this->dealers = new ArrayCollection();
        $this->subcontractedWorks = new ArrayCollection();
        $this->annexs = new ArrayCollection();
        $this->siteManagers = new ArrayCollection();
        $this->workDirectors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressConstrSite(): ?string
    {
        return $this->AddressConstrSite;
    }

    public function setAddressConstrSite(string $AddressConstrSite): self
    {
        $this->AddressConstrSite = $AddressConstrSite;

        return $this;
    }

    public function getAddressAccessSite(): ?string
    {
        return $this->AddressAccessSite;
    }

    public function setAddressAccessSite(string $AddressAccessSite): self
    {
        $this->AddressAccessSite = $AddressAccessSite;

        return $this;
    }

    public function getReferent(): ?string
    {
        return $this->referent;
    }

    public function setReferent(?string $referent): self
    {
        $this->referent = $referent;

        return $this;
    }

    public function getReferentPhone(): ?string
    {
        return $this->referentPhone;
    }

    public function setReferentPhone(?string $referentPhone): self
    {
        $this->referentPhone = $referentPhone;

        return $this;
    }

    public function getReferentMail(): ?string
    {
        return $this->referentMail;
    }

    public function setReferentMail(?string $referentMail): self
    {
        $this->referentMail = $referentMail;

        return $this;
    }

    public function getSiteType(): ?string
    {
        return $this->siteType;
    }

    public function setSiteType(?string $siteType): self
    {
        $this->siteType = $siteType;

        return $this;
    }

    public function getDescrWork(): ?string
    {
        return $this->descrWork;
    }

    public function setDescrWork(?string $descrWork): self
    {
        $this->descrWork = $descrWork;

        return $this;
    }

    public function getSubWorkDescr(): ?string
    {
        return $this->subWorkDescr;
    }

    public function setSubWorkDescr(?string $subWorkDescr): self
    {
        $this->subWorkDescr = $subWorkDescr;

        return $this;
    }

    public function getMandatoryDescr(): ?string
    {
        return $this->mandatoryDescr;
    }

    public function setMandatoryDescr(?string $mandatoryDescr): self
    {
        $this->mandatoryDescr = $mandatoryDescr;

        return $this;
    }

    public function getDateBegin(): ?\DateTimeInterface
    {
        return $this->dateBegin;
    }

    public function setDateBegin(?\DateTimeInterface $dateBegin): self
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(?\DateTimeInterface $dateEnd): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getOpeningSite(): ?\DateTimeInterface
    {
        return $this->openingSite;
    }

    public function setOpeningSite(?\DateTimeInterface $openingSite): self
    {
        $this->openingSite = $openingSite;

        return $this;
    }

    /**
     * Get dealers
     *
     * @return Collection
     */
    public function getDealers()
    {
        return $this->dealers;
    }
    
    public function getSiteName(): ?string
    {
        return $this->siteName;
    }

    public function setSiteName(?string $siteName): self
    {
        $this->siteName = $siteName;

        return $this;
    }

    public function getSiteNumber(): ?int
    {
        return $this->siteNumber;
    }

    public function setSiteNumber(?int $siteNumber): self
    {
        $this->siteNumber = $siteNumber;

        return $this;
    }

    public function getGlobalSiteAddress(): ?string
    {
        return $this->globalSiteAddress;
    }

    public function setGlobalSiteAddress(?string $globalSiteAddress): self
    {
        $this->globalSiteAddress = $globalSiteAddress;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(?string $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getProjectManager(): ?string
    {
        return $this->projectManager;
    }

    public function setProjectManager(?string $projectManager): self
    {
        $this->projectManager = $projectManager;

        return $this;
    }

    public function getPeriodOfExecution(): ?string
    {
        return $this->periodOfExecution;
    }

    public function setPeriodOfExecution(?string $periodOfExecution): self
    {
        $this->periodOfExecution = $periodOfExecution;

        return $this;
    }

    /**
     * @return Collection|Effective[]
     */
    public function getEffectives(): Collection
    {
        return $this->effectives;
    }

    public function addEffective(Effective $effective): self
    {
        if (!$this->effectives->contains($effective)) {
            $this->effectives[] = $effective;
            $effective->setPpsps($this);
        }

        return $this;
    }

    public function removeEffective(Effective $effective): self
    {
        if ($this->effectives->contains($effective)) {
            $this->effectives->removeElement($effective);
            // set the owning side to null (unless already changed)
            if ($effective->getPpsps() === $this) {
                $effective->setPpsps(null);
            }
        }

        return $this;
    }

    public function getSecurityCoordinator(): ?bool
    {
        return $this->securityCoordinator;
    }

    public function setSecurityCoordinator(?bool $securityCoordinator): self
    {
        $this->securityCoordinator = $securityCoordinator;

        return $this;
    }

    public function getPGC(): ?bool
    {
        return $this->PGC;
    }

    public function setPGC(?bool $PGC): self
    {
        $this->PGC = $PGC;

        return $this;
    }

    public function getInspectionVisit(): ?bool
    {
        return $this->inspectionVisit;
    }

    public function setInspectionVisit(?bool $inspectionVisit): self
    {
        $this->inspectionVisit = $inspectionVisit;

        return $this;
    }

    public function getSecurityCoordinatorName(): ?string
    {
        return $this->securityCoordinatorName;
    }

    public function setSecurityCoordinatorName(?string $securityCoordinatorName): self
    {
        $this->securityCoordinatorName = $securityCoordinatorName;

        return $this;
    }

    public function getPGCRef(): ?string
    {
        return $this->PGCRef;
    }

    public function setPGCRef(?string $PGCRef): self
    {
        $this->PGCRef = $PGCRef;

        return $this;
    }

    public function getPGCDate(): ?\DateTimeInterface
    {
        return $this->PGCDate;
    }

    public function setPGCDate(?\DateTimeInterface $PGCDate): self
    {
        $this->PGCDate = $PGCDate;

        return $this;
    }

    public function getInspectionVisitDate(): ?\DateTimeInterface
    {
        return $this->inspectionVisitDate;
    }

    public function setInspectionVisitDate(?\DateTimeInterface $inspectionVisitDate): self
    {
        $this->inspectionVisitDate = $inspectionVisitDate;

        return $this;
    }

    public function getListOfInstallations(): ?array
    {
        return $this->listOfInstallations;
    }

    public function setListOfInstallations(?array $listOfInstallations): self
    {
        $this->listOfInstallations = $listOfInstallations;

        return $this;
    }

    public function getMaintainer(): ?string
    {
        return $this->maintainer;
    }

    public function setMaintainer(?string $maintainer): self
    {
        $this->maintainer = $maintainer;

        return $this;
    }

    public function getSuiabilityList(): ?array
    {
        return $this->suiabilityList;
    }

    public function setSuiabilityList(?array $suiabilityList): self
    {
        $this->suiabilityList = $suiabilityList;

        return $this;
    }

    public function getSuiability(): ?string
    {
        return $this->suiability;
    }

    public function setSuiability(?string $suiability): self
    {
        $this->suiability = $suiability;

        return $this;
    }

    public function getOtherInstalation(): ?string
    {
        return $this->otherInstalation;
    }

    public function setOtherInstalation(?string $otherInstalation): self
    {
        $this->otherInstalation = $otherInstalation;

        return $this;
    }

    public function getMandatoryDocument(): ?array
    {
        return $this->mandatoryDocument;
    }

    public function setMandatoryDocument(?array $mandatoryDocument): self
    {
        $this->mandatoryDocument = $mandatoryDocument;

        return $this;
    }

    public function getParticularSecurityMeasure(): ?bool
    {
        return $this->particularSecurityMeasure;
    }

    public function setParticularSecurityMeasure(?bool $particularSecurityMeasure): self
    {
        $this->particularSecurityMeasure = $particularSecurityMeasure;

        return $this;
    }

    public function getParticularSecurityDetail(): ?bool
    {
        return $this->particularSecurityDetail;
    }

    public function setParticularSecurityDetail(?bool $particularSecurityDetail): self
    {
        $this->particularSecurityDetail = $particularSecurityDetail;

        return $this;
    }

    public function getSituation(): ?array
    {
        return $this->situation;
    }

    public function setSituation(?array $situation): self
    {
        $this->situation = $situation;

        return $this;
    }

    /**
     * @return Collection|Diffusion[]
     */
    public function getDiffusions(): Collection
    {
        return $this->diffusions;
    }

    public function addDiffusion(Diffusion $diffusion): self
    {
        if (!$this->diffusions->contains($diffusion)) {
            $this->diffusions[] = $diffusion;
            $diffusion->setPpsps($this);
        }

        return $this;
    }

    public function removeDiffusion(Diffusion $diffusion): self
    {
        if ($this->diffusions->contains($diffusion)) {
            $this->diffusions->removeElement($diffusion);
            // set the owning side to null (unless already changed)
            if ($diffusion->getPpsps() === $this) {
                $diffusion->setPpsps(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Speaker[]
     */
    public function getSpeakers(): Collection
    {
        return $this->speakers;
    }

    public function addSpeaker(Speaker $speaker): self
    {
        if (!$this->speakers->contains($speaker)) {
            $this->speakers[] = $speaker;
            $speaker->setPpsps($this);
        }

        return $this;
    }

    public function removeSpeaker(Speaker $speaker): self
    {
        if ($this->speakers->contains($speaker)) {
            $this->speakers->removeElement($speaker);
            // set the owning side to null (unless already changed)
            if ($speaker->getPpsps() === $this) {
                $speaker->setPpsps(null);
            }
        }

        return $this;
    }

    public function getMyCissct(): ?bool
    {
        return $this->myCissct;
    }

    public function setMyCissct(?bool $myCissct): self
    {
        $this->myCissct = $myCissct;

        return $this;
    }

    /**
     * @return Collection|UpdatePpsps[]
     */
    public function getUpdatesPpsps(): Collection
    {
        return $this->updatesPpsps;
    }

    public function addUpdatesPpsp(UpdatePpsps $updatesPpsp): self
    {
        if (!$this->updatesPpsps->contains($updatesPpsp)) {
            $this->updatesPpsps[] = $updatesPpsp;
            $updatesPpsp->setPpsps($this);
        }

        return $this;
    }

    public function removeUpdatesPpsp(UpdatePpsps $updatesPpsp): self
    {
        if ($this->updatesPpsps->contains($updatesPpsp)) {
            $this->updatesPpsps->removeElement($updatesPpsp);
            // set the owning side to null (unless already changed)
            if ($updatesPpsp->getPpsps() === $this) {
                $updatesPpsp->setPpsps(null);
            }
        }

        return $this;
    }

    public function addDealer(Dealer $dealer): self
    {
        if (!$this->dealers->contains($dealer)) {
            $this->dealers[] = $dealer;
            $dealer->setPpsps($this);
        }

        return $this;
    }

    public function removeDealer(Dealer $dealer): self
    {
        if ($this->dealers->contains($dealer)) {
            $this->dealers->removeElement($dealer);
            // set the owning side to null (unless already changed)
            if ($dealer->getPpsps() === $this) {
                $dealer->setPpsps(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSiteLevel(): ?string
    {
        return $this->siteLevel;
    }

    public function setSiteLevel(?string $siteLevel): self
    {
        $this->siteLevel = $siteLevel;

        return $this;
    }

    /**
     * @return Collection|SubcontractedWork[]
     */
    public function getSubcontractedWorks(): Collection
    {
        return $this->subcontractedWorks;
    }

    public function addSubcontractedWork(SubcontractedWork $subcontractedWork): self
    {
        if (!$this->subcontractedWorks->contains($subcontractedWork)) {
            $this->subcontractedWorks[] = $subcontractedWork;
            $subcontractedWork->setPpsps($this);
        }

        return $this;
    }

    public function removeSubcontractedWork(SubcontractedWork $subcontractedWork): self
    {
        if ($this->subcontractedWorks->contains($subcontractedWork)) {
            $this->subcontractedWorks->removeElement($subcontractedWork);
            // set the owning side to null (unless already changed)
            if ($subcontractedWork->getPpsps() === $this) {
                $subcontractedWork->setPpsps(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Annex[]
     */
    public function getAnnexs(): Collection
    {
        return $this->annexs;
    }

    public function addAnnex(Annex $annex): self
    {
        if (!$this->annexs->contains($annex)) {
            $this->annexs[] = $annex;
            $annex->setPpsps($this);
        }

        return $this;
    }

    public function removeAnnex(Annex $annex): self
    {
        if ($this->annexs->contains($annex)) {
            $this->annexs->removeElement($annex);
            // set the owning side to null (unless already changed)
            if ($annex->getPpsps() === $this) {
                $annex->setPpsps(null);
            }
        }

        return $this;
    }

    public function getBeginStopWork(): ?\DateTimeInterface
    {
        return $this->beginStopWork;
    }

    public function setBeginStopWork(?\DateTimeInterface $beginStopWork): self
    {
        $this->beginStopWork = $beginStopWork;

        return $this;
    }

    public function getEndStopWork(): ?\DateTimeInterface
    {
        return $this->endStopWork;
    }

    public function setEndStopWork(?\DateTimeInterface $endStopWork): self
    {
        $this->endStopWork = $endStopWork;

        return $this;
    }

    public function getOptionalDICTMessage(): ?string
    {
        return $this->optionalDICTMessage;
    }

    public function setOptionalDICTMessage(?string $optionalDICTMessage): self
    {
        $this->optionalDICTMessage = $optionalDICTMessage;

        return $this;
    }

    public function getIsMaintenedByRougeot(): ?bool
    {
        return $this->isMaintenedByRougeot;
    }

    public function setIsMaintenedByRougeot(?bool $isMaintenedByRougeot): self
    {
        $this->isMaintenedByRougeot = $isMaintenedByRougeot;

        return $this;
    }

    public function getAQSE(): ?Person
    {
        return $this->AQSE;
    }

    public function setAQSE(?Person $AQSE): self
    {
        $this->AQSE = $AQSE;

        return $this;
    }

    public function getGroupment(): ?Groupment
    {
        return $this->groupment;
    }

    public function setGroupment(?Groupment $groupment): self
    {
        $this->groupment = $groupment;

        return $this;
    }

    public function getIsControlled(): ?bool
    {
        return $this->isControlled;
    }

    public function setIsControlled(bool $isControlled): self
    {
        $this->isControlled = $isControlled;

        return $this;
    }

    public function getIsGuardian(): ?bool
    {
        return $this->isGuardian;
    }

    public function setIsGuardian(?bool $isGuardian): self
    {
        $this->isGuardian = $isGuardian;

        return $this;
    }

    public function getImage(): ?PpspsImage
    {
        return $this->image;
    }

    public function setImage(?PpspsImage $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getFirstWorkConductor(): ?string
    {
        return $this->firstWorkConductor;
    }

    public function setFirstWorkConductor(?string $firstWorkConductor): self
    {
        $this->firstWorkConductor = $firstWorkConductor;

        return $this;
    }

    public function getEditor(): ?string
    {
        return $this->editor;
    }

    public function setEditor(?string $editor): self
    {
        $this->editor = $editor;

        return $this;
    }

    public function getProjectDirector(): ?string
    {
        return $this->projectDirector;
    }

    public function setProjectDirector(?string $projectDirector): self
    {
        $this->projectDirector = $projectDirector;

        return $this;
    }

    public function getApprobator(): ?string
    {
        return $this->approbator;
    }

    public function setApprobator(?string $approbator): self
    {
        $this->approbator = $approbator;

        return $this;
    }

    public function getSecondApprobator(): ?string
    {
        return $this->secondApprobator;
    }

    public function setSecondApprobator(?string $secondApprobator): self
    {
        $this->secondApprobator = $secondApprobator;

        return $this;
    }

    public function getListOfWorksMandatoryDocs(): ?array
    {
        return $this->listOfWorksMandatoryDocs;
    }

    public function setListOfWorksMandatoryDocs(?array $listOfWorksMandatoryDocs): self
    {
        $this->listOfWorksMandatoryDocs = $listOfWorksMandatoryDocs;

        return $this;
    }

    public function getParticularExternalRisk(): ?bool
    {
        return $this->particularExternalRisk;
    }

    public function setParticularExternalRisk(bool $particularExternalRisk): self
    {
        $this->particularExternalRisk = $particularExternalRisk;

        return $this;
    }

    public function getAnnexSubworkers(): ?bool
    {
        return $this->annexSubworkers;
    }

    public function setAnnexSubworkers(bool $annexSubworkers): self
    {
        $this->annexSubworkers = $annexSubworkers;

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getSiteManagers(): Collection
    {
        return $this->siteManagers;
    }

    public function addSiteManager(Person $siteManager): self
    {
        if (!$this->siteManagers->contains($siteManager)) {
            $this->siteManagers[] = $siteManager;
        }

        return $this;
    }

    public function removeSiteManager(Person $siteManager): self
    {
        if ($this->siteManagers->contains($siteManager)) {
            $this->siteManagers->removeElement($siteManager);
        }

        return $this;
    }

    /**
     * @return Collection|Person[]
     */
    public function getWorkDirectors(): Collection
    {
        return $this->workDirectors;
    }

    public function addWorkDirector(Person $workDirector): self
    {
        if (!$this->workDirectors->contains($workDirector)) {
            $this->workDirectors[] = $workDirector;
        }

        return $this;
    }

    public function removeWorkDirector(Person $workDirector): self
    {
        if ($this->workDirectors->contains($workDirector)) {
            $this->workDirectors->removeElement($workDirector);
        }

        return $this;
    }

    public function getMondayMorning(): ?string
    {
        return $this->MondayMorning;
    }

    public function setMondayMorning(?string $MondayMorning): self
    {
        $this->MondayMorning = $MondayMorning;

        return $this;
    }

    public function getMondayAfternoon(): ?string
    {
        return $this->MondayAfternoon;
    }

    public function setMondayAfternoon(?string $MondayAfternoon): self
    {
        $this->MondayAfternoon = $MondayAfternoon;

        return $this;
    }

    public function getTuesdayMorning(): ?string
    {
        return $this->tuesdayMorning;
    }

    public function setTuesdayMorning(?string $tuesdayMorning): self
    {
        $this->tuesdayMorning = $tuesdayMorning;

        return $this;
    }

    public function getTuesdayAfternoon(): ?string
    {
        return $this->tuesdayAfternoon;
    }

    public function setTuesdayAfternoon(?string $tuesdayAfternoon): self
    {
        $this->tuesdayAfternoon = $tuesdayAfternoon;

        return $this;
    }

    public function getWednesdayMorning(): ?string
    {
        return $this->wednesdayMorning;
    }

    public function setWednesdayMorning(?string $wednesdayMorning): self
    {
        $this->wednesdayMorning = $wednesdayMorning;

        return $this;
    }

    public function getWednesdayAfternoon(): ?string
    {
        return $this->wednesdayAfternoon;
    }

    public function setWednesdayAfternoon(?string $wednesdayAfternoon): self
    {
        $this->wednesdayAfternoon = $wednesdayAfternoon;

        return $this;
    }

    public function getThursdayMorning(): ?string
    {
        return $this->thursdayMorning;
    }

    public function setThursdayMorning(?string $thursdayMorning): self
    {
        $this->thursdayMorning = $thursdayMorning;

        return $this;
    }

    public function getThursdayAfternoon(): ?string
    {
        return $this->thursdayAfternoon;
    }

    public function setThursdayAfternoon(?string $thursdayAfternoon): self
    {
        $this->thursdayAfternoon = $thursdayAfternoon;

        return $this;
    }

    public function getFridayMorning(): ?string
    {
        return $this->fridayMorning;
    }

    public function setFridayMorning(?string $fridayMorning): self
    {
        $this->fridayMorning = $fridayMorning;

        return $this;
    }

    public function getFridayAfternoon(): ?string
    {
        return $this->fridayAfternoon;
    }

    public function setFridayAfternoon(?string $fridayAfternoon): self
    {
        $this->fridayAfternoon = $fridayAfternoon;

        return $this;
    }
}
