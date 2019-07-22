<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnexRepository")
 * @Vich\Uploadable
 */
class Annex
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Unmapped property to handle file uploads
     * @Vich\UploadableField(mapping="annexs", fileNameProperty="name")
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ppsps", inversedBy="annexs")
     */
    private $ppsps;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $annexName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;
    
    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return Annex
    */
    public function setFile(File $file = null)
    {
        $this->file = $file;

        if ($file) 
            $this->updatedAt = new \DateTimeImmutable();
        
        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile()
    {
        return $this->file;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
    
    public function getAnnexName(): ?string
    {
        return $this->annexName;
    }

    public function setAnnexName(?string $annexName): self
    {
        $this->annexName = $annexName;

        return $this;
    }

}
