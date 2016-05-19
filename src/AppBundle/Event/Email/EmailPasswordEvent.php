<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Event\Email;

use Symfony\Component\EventDispatcher\Event;
/**
 * Description of EmailEvent
 *
 * @author student
 */
class EmailPasswordEvent extends Event
{
    private $email;
    
    private $password;
        
    public function __construct($email, $password) 
    {
        $this->email = $email;
        $this->password = $password;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
}
