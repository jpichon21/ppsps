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
     * @ORM\Column(type="array", length=255, nullable=true)
     */
    private $rest = [];

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $winterRestBegin;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $winterRestEnd;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $summerRestBegin;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $summerRestEnd;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $openingSite;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startingWork;

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
     * @ORM\OneToMany(targetEntity="App\Entity\Effective", mappedBy="ppsps", cascade={"persist"})
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $maintainer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $otherMaintainer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $accomodationDescr;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $particularSecurityDetail;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $situation = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Diffusion", mappedBy="ppsps", cascade={"persist"})
     */
    private $diffusions;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $accomodation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Speaker", mappedBy="ppsps", cascade={"persist"})
     */
    private $speakers;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $otherRestBegin;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $otherRestEnd;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $chiefWorkRepresentative;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $myCissct;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UpdatePpsps", mappedBy="ppsps", cascade={"persist"})
     */
    private $updatesPpsps;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dealer", mappedBy="ppsps", cascade={"persist"})
     */
    private $dealers;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AQSE;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $workDirector;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $masterCompanion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Leader", mappedBy="ppsps", cascade={"persist"})
     */
    private $leaders;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SiteManager", mappedBy="ppsps", cascade={"persist"})
     */
    private $siteManagers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WorkDirector", mappedBy="ppsps", cascade={"persist"})
     */
    private $workDirectors;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

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
        $this->leaders = new ArrayCollection();
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

    public function getRest(): ?array
    {
        return $this->rest;
    }

    public function setRest(?array $rest): self
    {
        $this->rest = $rest;

        return $this;
    }

    public function getWinterRestBegin(): ?\DateTimeInterface
    {
        return $this->winterRestBegin;
    }

    public function setWinterRestBegin(?\DateTimeInterface $winterRestBegin): self
    {
        $this->winterRestBegin = $winterRestBegin;

        return $this;
    }

    public function getWinterRestEnd(): ?\DateTimeInterface
    {
        return $this->winterRestEnd;
    }

    public function setWinterRestEnd(?\DateTimeInterface $winterRestEnd): self
    {
        $this->winterRestEnd = $winterRestEnd;

        return $this;
    }

    public function getSummerRestBegin(): ?\DateTimeInterface
    {
        return $this->summerRestBegin;
    }

    public function setSummerRestBegin(?\DateTimeInterface $summerRestBegin): self
    {
        $this->summerRestBegin = $summerRestBegin;

        return $this;
    }

    public function getSummerRestEnd(): ?\DateTimeInterface
    {
        return $this->summerRestEnd;
    }

    public function setSummerRestEnd(?\DateTimeInterface $summerRestEnd): self
    {
        $this->summerRestEnd = $summerRestEnd;

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

    public function getStartingWork(): ?\DateTimeInterface
    {
        return $this->startingWork;
    }

    public function setStartingWork(?\DateTimeInterface $startingWork): self
    {
        $this->startingWork = $startingWork;

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

    public function getMaintainer(): ?bool
    {
        return $this->maintainer;
    }

    public function setMaintainer(?bool $maintainer): self
    {
        $this->maintainer = $maintainer;

        return $this;
    }

    public function getOtherMaintainer(): ?string
    {
        return $this->otherMaintainer;
    }

    public function setOtherMaintainer(?string $otherMaintainer): self
    {
        $this->otherMaintainer = $otherMaintainer;

        return $this;
    }

    public function getAccomodationDescr(): ?string
    {
        return $this->accomodationDescr;
    }

    public function setAccomodationDescr(?string $accomodationDescr): self
    {
        $this->accomodationDescr = $accomodationDescr;

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

    public function getParticularSecurityDetail(): ?string
    {
        return $this->particularSecurityDetail;
    }

    public function setParticularSecurityDetail(?string $particularSecurityDetail): self
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

    public function getAccomodation(): ?bool
    {
        return $this->accomodation;
    }

    public function setAccomodation(?bool $accomodation): self
    {
        $this->accomodation = $accomodation;

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

    public function getOtherRestBegin(): ?\DateTimeInterface
    {
        return $this->otherRestBegin;
    }

    public function setOtherRestBegin(?\DateTimeInterface $otherRestBegin): self
    {
        $this->otherRestBegin = $otherRestBegin;

        return $this;
    }

    public function getOtherRestEnd(): ?\DateTimeInterface
    {
        return $this->otherRestEnd;
    }

    public function setOtherRestEnd(?\DateTimeInterface $otherRestEnd): self
    {
        $this->otherRestEnd = $otherRestEnd;

        return $this;
    }

    public function getChiefWorkRepresentative(): ?string
    {
        return $this->chiefWorkRepresentative;
    }

    public function setChiefWorkRepresentative(?string $chiefWorkRepresentative): self
    {
        $this->chiefWorkRepresentative = $chiefWorkRepresentative;

        return $this;
    }

    public function getMyCissct(): ?string
    {
        return $this->myCissct;
    }

    public function setMyCissct(?string $myCissct): self
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

    public function getAQSE(): ?string
    {
        return $this->AQSE;
    }

    public function setAQSE(?string $AQSE): self
    {
        $this->AQSE = $AQSE;

        return $this;
    }

    public function getWorkDirector(): ?string
    {
        return $this->workDirector;
    }

    public function setWorkDirector(?string $workDirector): self
    {
        $this->workDirector = $workDirector;

        return $this;
    }

    public function getMasterCompanion(): ?string
    {
        return $this->masterCompanion;
    }

    public function setMasterCompanion(?string $masterCompanion): self
    {
        $this->masterCompanion = $masterCompanion;

        return $this;
    }

    /**
     * @return Collection|Leader[]
     */
    public function getLeaders(): Collection
    {
        return $this->leaders;
    }

    public function addLeader(Leader $leader): self
    {
        if (!$this->leaders->contains($leader)) {
            $this->leaders[] = $leader;
            $leader->setPpsps($this);
        }

        return $this;
    }

    public function removeLeader(Leader $leader): self
    {
        if ($this->leaders->contains($leader)) {
            $this->leaders->removeElement($leader);
            // set the owning side to null (unless already changed)
            if ($leader->getPpsps() === $this) {
                $leader->setPpsps(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SiteManager[]
     */
    public function getSiteManagers(): Collection
    {
        return $this->siteManagers;
    }

    public function addSiteManager(SiteManager $siteManager): self
    {
        if (!$this->siteManagers->contains($siteManager)) {
            $this->siteManagers[] = $siteManager;
            $siteManager->setPpsps($this);
        }

        return $this;
    }

    public function removeSiteManager(SiteManager $siteManager): self
    {
        if ($this->siteManagers->contains($siteManager)) {
            $this->siteManagers->removeElement($siteManager);
            // set the owning side to null (unless already changed)
            if ($siteManager->getPpsps() === $this) {
                $siteManager->setPpsps(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|WorkDirector[]
     */
    public function getWorkDirectors(): Collection
    {
        return $this->workDirectors;
    }

    public function addWorkDirector(WorkDirector $workDirector): self
    {
        if (!$this->workDirectors->contains($workDirector)) {
            $this->workDirectors[] = $workDirector;
            $workDirector->setPpsps($this);
        }

        return $this;
    }

    public function removeWorkDirector(WorkDirector $workDirector): self
    {
        if ($this->workDirectors->contains($workDirector)) {
            $this->workDirectors->removeElement($workDirector);
            // set the owning side to null (unless already changed)
            if ($workDirector->getPpsps() === $this) {
                $workDirector->setPpsps(null);
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
}
