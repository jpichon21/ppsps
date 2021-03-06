<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PpspsImageRepository")
 * @Vich\Uploadable
 */
class PpspsImage implements \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="ppsps_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ppsps", mappedBy="image")
     */
    private $ppsps;

    public function __construct()
    {
        $this->ppsps = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
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

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->image,
            $this->updatedAt,
            $this->name,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
        $this->id,
        $this->image,
        $this->updatedAt,
        $this->name,
        ) = unserialize($serialized);
    }

    /**
     * @return Collection|Ppsps[]
     */
    public function getPpsps(): Collection
    {
        return $this->ppsps;
    }

    public function addPpsp(Ppsps $ppsp): self
    {
        if (!$this->ppsps->contains($ppsp)) {
            $this->ppsps[] = $ppsp;
            $ppsp->setImage($this);
        }

        return $this;
    }

    public function removePpsp(Ppsps $ppsp): self
    {
        if ($this->ppsps->contains($ppsp)) {
            $this->ppsps->removeElement($ppsp);
            // set the owning side to null (unless already changed)
            if ($ppsp->getImage() === $this) {
                $ppsp->setImage(null);
            }
        }

        return $this;
    }
}
