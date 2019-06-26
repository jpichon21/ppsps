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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateBegin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\Column(type="array", length=255, nullable=true)
     */
    private $rest = [];

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $winterRestBegin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $winterRestEnd;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $summerRestBegin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $summerRestEnd;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $openingSite;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startingWork;

    /**
    * @ORM\OneToMany(targetEntity="Dealer", mappedBy="ppsps", orphanRemoval=true)
    */
    private $dealers;

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
     * @ORM\OneToMany(targetEntity="App\Entity\People", mappedBy="organisation")
     */
    private $organisationOfPeoples;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cissct;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Effective", mappedBy="ppsps")
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $PGCDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
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
     * @ORM\OneToMany(targetEntity="App\Entity\Update", mappedBy="ppsps")
     */
    private $updates;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Diffusion", mappedBy="ppsps")
     */
    private $diffusions;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $accomodation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Speaker", mappedBy="ppsps")
     */
    private $speakers;

    /**
     * Constructor
    */
    public function __construct()
    {
        $this->dealers = new ArrayCollection();
        $this->speaker = new ArrayCollection();
        $this->organisationOfPeoples = new ArrayCollection();
        $this->effectives = new ArrayCollection();
        $this->updates = new ArrayCollection();
        $this->diffusions = new ArrayCollection();
        $this->speakers = new ArrayCollection();
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

    /**
     * Add dealers
     *
     * @param Dealer $dealers
     *
     * @return Category
     */
    public function addDealer($dealers)
    {
        $this->dealers[] = $dealers;

        return $this;
    }

    /**
     * Remove dealers
     *
     * @param Dealer $dealers
     */
    public function removeDealer($dealers)
    {
        $this->dealers->removeElement($dealers);
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
     * @return Collection|People[]
     */
    public function getOrganisationOfPeoples(): Collection
    {
        return $this->organisationOfPeoples;
    }

    public function addOrganisationOfPeople(People $organisationOfPeople): self
    {
        if (!$this->organisationOfPeoples->contains($organisationOfPeople)) {
            $this->organisationOfPeoples[] = $organisationOfPeople;
            $organisationOfPeople->setOrganisation($this);
        }

        return $this;
    }

    public function removeOrganisationOfPeople(People $organisationOfPeople): self
    {
        if ($this->organisationOfPeoples->contains($organisationOfPeople)) {
            $this->organisationOfPeoples->removeElement($organisationOfPeople);
            // set the owning side to null (unless already changed)
            if ($organisationOfPeople->getOrganisation() === $this) {
                $organisationOfPeople->setOrganisation(null);
            }
        }

        return $this;
    }

    public function getCissct(): ?string
    {
        return $this->cissct;
    }

    public function setCissct(?string $cissct): self
    {
        $this->cissct = $cissct;

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
     * @return Collection|Update[]
     */
    public function getUpdates(): Collection
    {
        return $this->updates;
    }

    public function addUpdate(Update $update): self
    {
        if (!$this->updates->contains($update)) {
            $this->updates[] = $update;
            $update->setPpsps($this);
        }

        return $this;
    }

    public function removeUpdate(Update $update): self
    {
        if ($this->updates->contains($update)) {
            $this->updates->removeElement($update);
            // set the owning side to null (unless already changed)
            if ($update->getPpsps() === $this) {
                $update->setPpsps(null);
            }
        }

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
}
