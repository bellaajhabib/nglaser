<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Tests\Helper;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use AppBundle\Helper\StringHelper;

/**
 * Description of StringHelperTest
 *
 * @author student
 */
class StringHelperTest extends WebTestCase
{
    public function testRandomString()
    {
        $helper = new StringHelper();
        $this->assertFalse($helper->randomString() === $helper->randomString());
        $this->assertFalse($helper->randomString() === $helper->randomString());
        $this->assertFalse($helper->randomString() === $helper->randomString());
        $this->assertFalse($helper->randomString() === $helper->randomString());
    }
    
    public function testSimpleSlugMethod()
    {
        $helper = new StringHelper();
        $this->assertEquals('home', $helper->simpleSlug('HOme'));
        $this->assertEquals('people-are-cool', $helper->simpleSlug('people are COOL') );
    }
}
