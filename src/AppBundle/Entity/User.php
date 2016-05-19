<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 * @UniqueEntity("email", message="You enter an email address that already exists in the system.", groups={"admin"})
 */
class User extends BaseEntity implements AdvancedUserInterface, \Serializable
{


    /**
     * @var string
     * @Assert\Email(message="You enter an invalid email address.", groups={ "admin"})
     * @Assert\NotBlank(message="You enter an invalid email address.", groups={"admin"})
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * Set email
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
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
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
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    public function eraseCredentials() 
    {
        return true;
    }

    public function getSalt() 
    {
        return null;
    }

    public function getUsername() 
    {
        return true;        
    }

    public function isAccountNonExpired() 
    {
        return true;        
    }

    public function isAccountNonLocked() 
    {
        return true;
    }

    public function isCredentialsNonExpired() 
    {
        return true;
    }

    public function isEnabled() 
    {
        return $this->isActive;
    }
    
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->isActive,
            $this->email,
            $this->roles,
            $this->password
        ]);
    }
    
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->isActive,
            $this->email,
            $this->roles,
            $this->password
        ) = unserialize($serialized);
    }
    
    public function __toString() 
    {
        return 'User';
    }

}

