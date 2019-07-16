<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupmentRepository")
 */
class Groupment
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
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="groupment")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ppsps", mappedBy="groupment")
     */
    private $ppsps;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupmentLogo", inversedBy="groupments", cascade={"persist"})
     */
    private $logo;


    /**
     * to string method
     *
     * @return string
    */
    public function __toString()
    {
        return $this->getName();
    }

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->ppsps = new ArrayCollection();
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

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setGroupment($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getGroupment() === $this) {
                $user->setGroupment(null);
            }
        }

        return $this;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return Group
    */
    public function setGroupLogo(File $groupLogo = null)
    {
        $this->groupLogo = $groupLogo;

        if ($groupLogo) 
            $this->updatedAt = new \DateTimeImmutable();
        
        return $this;
    }

    /**
     * @return File|null
     */
    public function getGroupLogo()
    {
        return $this->groupLogo;
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
            $ppsp->setGroupment($this);
        }

        return $this;
    }

    public function removePpsp(Ppsps $ppsp): self
    {
        if ($this->ppsps->contains($ppsp)) {
            $this->ppsps->removeElement($ppsp);
            // set the owning side to null (unless already changed)
            if ($ppsp->getGroupment() === $this) {
                $ppsp->setGroupment(null);
            }
        }

        return $this;
    }

    public function getLogo(): ?GroupmentLogo
    {
        return $this->logo;
    }

    public function setLogo(?GroupmentLogo $logo): self
    {
        $this->logo = $logo;

        return $this;
    }
}
