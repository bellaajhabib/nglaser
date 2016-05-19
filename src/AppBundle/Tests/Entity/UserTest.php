<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Tests;

use AppBundle\Entity\User;
use AppBundle\Entity\BaseEntity;

/**
 * Description of UserTest
 *
 * @author student
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testSerializeUser() 
    {
        $user = new User();
        $user->setId(4);
        $user->setIsActive(true);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword('moo');
        $user->setEmail('moo@gmail.com');
        $serialized = $user->serialize();
        $this->assertEquals([4, true, 'moo@gmail.com', ['ROLE_ADMIN'], 'moo'  ], unserialize($serialized));
    }
    
    public function testUnserialize()
    {
        $user = new User();
        $user->unserialize(serialize([4, true, 'moo@gmail.com', ['ROLE_ADMIN'], 'moo'  ]));
        $this->assertEquals('moo', $user->getPassword());
        $this->assertEquals('moo@gmail.com', $user->getEmail());
        $this->assertEquals(['ROLE_ADMIN'], $user->getRoles());
        $this->assertEquals(4, $user->getId());
    }
}
