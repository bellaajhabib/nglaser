<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Tests\Twig;

use AppBundle\Twig\s3UrlExtension;
use Liip\FunctionalTestBundle\Test\WebTestCase;

/**
 * Description of s3UrlExtensionTest
 *
 * @author student
 */
class s3UrlExtensionTest extends WebTestCase
{
    public function testTwigS3UrlFilter()
    {
        $s3Manager = $this->getMockBuilder('AppBundle\Component\S3Manager')->disableOriginalConstructor()->getMock();
        $s3Manager->expects($this->once())->method('getUrlForObject')->with('random_key.jpg')->willReturn('random_key.jpg');  
        $s3Twig = new s3UrlExtension($s3Manager);
        $url = $s3Twig->s3UrlFilter('random_key.jpg');
        $this->assertEquals('random_key.jpg', $url);
    }
    
    public function testGetName()
    {
        $s3Manager = $this->getMockBuilder('AppBundle\Component\S3Manager')->disableOriginalConstructor()->getMock();
        $s3Twig = new s3UrlExtension($s3Manager);
        $this->assertEquals('s3_url_extension', $s3Twig->getName());
    }
}
