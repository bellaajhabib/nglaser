<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Tests\EventListener\Email;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use AppBundle\EventListener\Email\EmailListener;
use AppBundle\Event\Email\EmailPasswordEvent;

/**
 * Description of EmailListenerTest
 *
 * @author student
 */
class EmailListenerTest extends WebTestCase
{
    public function testSendNewUserPasswordEmail()
    {        
        $emailManager = $this->getMockBuilder('AppBundle\Component\EmailManager')->disableOriginalConstructor()->getMock();
        $emailManager->expects($this->once())->method('addEmailToSendList');
        
        $twig = $this->getMockBuilder('\Twig_Environment')->disableOriginalConstructor()->getMock();
        $twig->expects($this->once())->method('render');
        
        $emailListener = new EmailListener($twig, $emailManager);
        $emailListener->sendNewUserPasswordEmail($this->generateEvent());
    }
    
    public function testSendResetPasswordEmail()
    {        
        $emailManager = $this->getMockBuilder('AppBundle\Component\EmailManager')->disableOriginalConstructor()->getMock();
        $emailManager->expects($this->once())->method('addEmailToSendList');
        $twig = $this->getMockBuilder('\Twig_Environment')->disableOriginalConstructor()->getMock();
        $twig->expects($this->once())->method('render');
        $emailListener = new EmailListener($twig, $emailManager);
        $emailListener->sendResetPasswordEmail($this->generateEvent());
    }
    
    public function generateEvent()
    {
        return new EmailPasswordEvent('goo@gmail.com', 'password');
    }
}
