<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements UserInterface
{
    const ROLES = [
        'Conducteur de travaux' => 'ROLE_USER',
        'Administrateur' => 'ROLE_ADMIN',
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string", length=191, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="password", type="string",  length=191, nullable=true)
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="roles", type="json_array")
     */
    private $roles = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupment", inversedBy="users")
     * @ORM\JoinColumn(name="groupment_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $groupment;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    
    /**
     * to string method
     *
     * @return string
    */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param bool $id
     *
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set roles.
     *
     * @param json $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = [];
        foreach ($roles as $role) {
            $this->addRole($role);
        }
        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get password.
     *
     * @return Array
     */
    public function getRoles()
    {
        return $this->roles;
    }
    
    /**
     * void
     */
    public function getSalt()
    {
    }

    /**
     * Get username. (used by SonataAdminBundle)
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * void
     */
    public function eraseCredentials()
    {
    }

    /**
     * Add role.
     *
     * @param string $role
     * @return User
     */
    public function addRole($role)
    {
        if (!$role) {
            return $this;
        }
        $role = strtoupper($role);
        $this->roles[] = $role;
        return $this;
    }

    public function isAllowed() {
        if(in_array('ROLE_USER',$this->roles)) {
            return true;
        }
        if(in_array('ROLE_ADMIN',$this->roles)) {
            return true;
        }
        return false;
    }

    public function getGroupment(): ?Groupment
    {
        return $this->groupment;
    }

    public function setGroupment(?Groupment $groupment): self
    {
        $this->groupment = $groupment;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set plainPassword.
     *
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

        /**
     * Get plainPassword.
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
}