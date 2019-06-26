<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DealerRepository")
 */
class Dealer
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
    private $mail;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $sendingDate;

    /**
     * @ORM\ManyToOne(targetEntity="Ppsps", inversedBy="dealers")
     * @ORM\JoinColumn(name="Ppsp_id", referencedColumnName="id", nullable=false)
    */
    private $ppsps;

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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getSendingDate(): ?\DateTimeInterface
    {
        return $this->sendingDate;
    }

    public function setSendingDate(?\DateTimeInterface $sendingDate): self
    {
        $this->sendingDate = $sendingDate;

        return $this;
    }

    /**
     * Get ppsps
     *
     * @return Collection
     */
    public function getPpsps()
    {
        return $this->ppsps;
    }
    
    public function setPpsps($ppsps)
    {
        $this->ppsps = $ppsps;

        return $this;
    }
}
