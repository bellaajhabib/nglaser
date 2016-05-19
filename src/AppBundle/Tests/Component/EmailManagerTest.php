<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Tests\Component;

use AppBundle\Component\EmailManager;
use AppBundle\Entity\User;
use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Description of EmailManagerTest
 *
 * @author student
 */
class EmailManagerTest extends WebTestCase
{
    public function testAddingMessagesInQueue()
    {
        $swiftmailer = $this->getMockBuilder('\Swift_Mailer')->disableOriginalConstructor()->getMock();
        $emailManager = new EmailManager($swiftmailer);
        $this->assertCount(0, $emailManager->getMessages());
        $emailManager->addEmailToSendList($this->generateSwitfMessage());
        $emailManager->addEmailToSendList($this->generateSwitfMessage());
        $emailManager->addEmailToSendList($this->generateSwitfMessage());
        $emailManager->addEmailToSendList($this->generateSwitfMessage());
        $this->assertCount(4, $emailManager->getMessages());
    }
    
    public function testSendEmail()
    {
        $swiftmailer = $this->getMockBuilder('\Swift_Mailer')->disableOriginalConstructor()->getMock();
        $swiftmailer->expects($this->exactly(4))->method('send');
        $emailManager = new EmailManager($swiftmailer);
        $this->assertCount(0, $emailManager->getMessages());
        $emailManager->addEmailToSendList($this->generateSwitfMessage());
        $emailManager->addEmailToSendList($this->generateSwitfMessage());
        $emailManager->addEmailToSendList($this->generateSwitfMessage());
        $emailManager->addEmailToSendList($this->generateSwitfMessage());
        $emailManager->sendEmails();
    }
    
    public function generateSwitfMessage()
    {
        return $this->getMockBuilder('\Swift_Message')->disableOriginalConstructor()->getMock();
    }
}
