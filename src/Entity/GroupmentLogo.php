<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupmentLogoRepository")
 * @Vich\Uploadable
 */
class GroupmentLogo implements \Serializable
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
     * @Vich\UploadableField(mapping="group_logo", fileNameProperty="image")
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
     * @ORM\OneToMany(targetEntity="App\Entity\Groupment", mappedBy="logo", cascade={"persist"})
     */
    private $groupments;

    public function __construct()
    {
        $this->groupments = new ArrayCollection();
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
       * @return Collection|Groupment[]
       */
      public function getGroupments(): Collection
      {
          return $this->groupments;
      }

      public function addGroupment(Groupment $groupment): self
      {
          if (!$this->groupments->contains($groupment)) {
              $this->groupments[] = $groupment;
              $groupment->setLogo($this);
          }

          return $this;
      }

      public function removeGroupment(Groupment $groupment): self
      {
          if ($this->groupments->contains($groupment)) {
              $this->groupments->removeElement($groupment);
              // set the owning side to null (unless already changed)
              if ($groupment->getLogo() === $this) {
                  $groupment->setLogo(null);
              }
          }

          return $this;
      }
}
