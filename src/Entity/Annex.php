<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnexRepository")
 */
class Annex
{
    const SERVER_PATH_TO_ADMIN_FOLDER = '../public/annexs';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Unmapped property to handle file uploads
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $filename;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @param UploadedFile $file
     */
    public function setFile($file = null)
    {
        $this->file = $file;
    }

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Manages the copying of the file to the relevant place on the server
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and target filename as params
        $this->getFile()->move(
            self::SERVER_PATH_TO_ADMIN_FOLDER,
            $this->getFile()->getClientOriginalName()
        );
        // set the path property to the filename where you've saved the file
        $this->filename = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->setFile(null);
    }

    /**
        * Lifecycle callback to upload the file to the server.
        */
    public function lifecycleFileUpload()
    {
        $this->upload();
    }

    /**
        * Updates the hash value to force the preUpdate and postUpdate events to fire.
        */
    public function refreshUpdated()
    {
        $this->setUpdated(new \DateTime());
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

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getUpdated(): ?\DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?\DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }
}
