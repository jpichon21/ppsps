<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UpdateRepository")
 */
class UpdatePpsps
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
    private $updateObject;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $indexUpdate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $updateDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $writeBy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aprovedBy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ppsps", inversedBy="updatesPpsps")
     */
    private $ppsps;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUpdateObject(): ?string
    {
        return $this->updateObject;
    }

    public function setUpdateObject(?string $updateObject): self
    {
        $this->updateObject = $updateObject;

        return $this;
    }

    public function getIndexUpdate(): ?int
    {
        return $this->indexUpdate;
    }

    public function setIndexUpdate(?int $indexUpdate): self
    {
        $this->indexUpdate = $indexUpdate;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(?\DateTimeInterface $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    public function getWriteBy(): ?string
    {
        return $this->writeBy;
    }

    public function setWriteBy(?string $writeBy): self
    {
        $this->writeBy = $writeBy;

        return $this;
    }

    public function getAprovedBy(): ?string
    {
        return $this->aprovedBy;
    }

    public function setAprovedBy(?string $aprovedBy): self
    {
        $this->aprovedBy = $aprovedBy;

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
