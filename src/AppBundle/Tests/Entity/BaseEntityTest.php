<?php

namespace AppBundle\Tests;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use AppBundle\Entity\User;
use AppBundle\Entity\BaseEntity;
/**
 * Description of BaseEntityTest
 *
 * @author student
 */
class BaseEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testPrePerist()
    {
        $user = new User();
        $this->assertTrue($user instanceof BaseEntity);
        $user->prePerist();
        $this->assertEquals((new \DateTime())->format('Y-m-d h:i:s'), $user->getCreatedAt()->format('Y-m-d h:i:s'));
        $this->assertEquals((new \DateTime())->format('Y-m-d h:i:s'), $user->getUpdatedAt()->format('Y-m-d h:i:s'));
    }
    
    public function testPreUpdate()
    {
        $user = new User();
        $this->assertTrue($user instanceof BaseEntity);
        $user->prePerist();
        $this->assertEquals((new \DateTime())->format('Y-m-d h:i:s'), $user->getUpdatedAt()->format('Y-m-d h:i:s'));
    }
}
