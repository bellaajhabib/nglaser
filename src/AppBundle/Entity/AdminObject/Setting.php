<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Entity\AdminObject;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


class Setting 
{

    /**
     * @Assert\NotBlank(groups={"admin"}, message="Name can not be blank.")
     * @Assert\Length(groups={"admin"}, min=5, max=60, minMessage="Name must be between 5 to 80 characters long.", maxMessage="Name must be between 5 to 60 characters long.")
     */
    private $name;
    
    /**
     * @var string
     * @Assert\Email(message="You enter an invalid email address.", groups={ "admin"})
     * @Assert\NotBlank(message="You enter an invalid email address.", groups={"admin"})
     */
    private $email;
    
    /**
     * @Assert\NotBlank(groups={"admin"}, message="City can not be blank.")
     * @Assert\Length(groups={"admin"}, min=5, max=60, minMessage="Name must be between 5 to 80 characters long.", maxMessage="Name must be between 5 to 60 characters long.")
     */
    private $city;
    
    /**
     * @Assert\NotBlank(groups={"admin"}, message="State can not be blank.")
     * @Assert\Length(groups={"admin"}, min=2, max=2, minMessage="Name must be 2 characters long.", maxMessage="Name must be between 2 characters long.")
     */
    private $state;
    
    public function getName() 
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setName($name) 
    {
        $this->name = $name;
        
        return $this;
    }

    public function setEmail($email) 
    {
        $this->email = $email;
        
        return $this;
    }


    public function getCity() 
    {
        return $this->city;
    }

    public function getState() 
    {
        return $this->state;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function setState($state) 
    {
        $this->state = $state;
        return $this;
    }



    
}
