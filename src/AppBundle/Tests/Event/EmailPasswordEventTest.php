<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Tests\Event;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use AppBundle\Event\Email\EmailPasswordEvent;

/**
 * Description of EmailEventTest
 *
 * @author student
 */
class EmailResetPasswordEventTest extends WebTestCase
{
    public function testEmailEvent()
    {
        $emailevent = new EmailPasswordEvent('moo@gmail.com', 'bluemoon');
        $this->assertEquals('moo@gmail.com', $emailevent->getEmail());
        $this->assertEquals('bluemoon', $emailevent->getPassword());
    }
}
