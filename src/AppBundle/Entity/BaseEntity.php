<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;


/**
 * Description of BaseEntity
 * @ORM\MappedSuperclass()
 * @ORM\HasLifecycleCallbacks()
 * @author student
 */
abstract class BaseEntity
{
    
    /**
     * The Entity Id
     * @var integer
     * @Groups({"detail", "list"})
     * @Type("integer")
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /** 
     * The Entity's Created Date
     * @var \DateTime 
     * @Type("DateTime<'m/d/Y'>")
     * @Groups({"detail"})
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;
    
    /** 
     * The Entity's Updated Date
     * @var \DateTime
     * @Groups({"detail"})
     * @Type("DateTime<'m/d/Y'>")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;
    
    public function setCreatedAt($createdAt) 
    {
        $this->createdAt = $createdAt;
        
        return $this;
    }
    
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        
        return $this;
    }
    
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /** 
     * Set Id
     * @param type $id
     * @return \AppBundle\Entity\BaseEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    /** 
     * @ORM\PrePersist()
     */    
    public function prePerist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
    
    /** 
     * @ORM\PreUpdate()
     */
    public function preUpdate() 
    {
        $this->updatedAt = new \DateTime();
    }
}
