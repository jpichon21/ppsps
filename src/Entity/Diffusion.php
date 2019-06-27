<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiffusionRepository")
 */
class Diffusion
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
    private $recipient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $paper;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isNumeric;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ppsps", inversedBy="diffusions")
     */
    private $ppsps;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $external;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipient(): ?string
    {
        return $this->recipient;
    }

    public function setRecipient(?string $recipient): self
    {
        $this->recipient = $recipient;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPaper(): ?bool
    {
        return $this->paper;
    }

    public function setPaper(?bool $paper): self
    {
        $this->paper = $paper;

        return $this;
    }

    public function getIsNumeric(): ?bool
    {
        return $this->isNumeric;
    }

    public function setIsNumeric(?bool $isNumeric): self
    {
        $this->isNumeric = $isNumeric;

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

    public function getExternal(): ?bool
    {
        return $this->external;
    }

    public function setExternal(?bool $external): self
    {
        $this->external = $external;

        return $this;
    }
}
