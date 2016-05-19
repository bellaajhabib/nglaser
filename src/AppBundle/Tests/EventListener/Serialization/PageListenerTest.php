<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Tests\EventListener\Serialization;

use AppBundle\Entity\Page;
use AppBundle\EventListener\Serialization\PageListener;
/**
 * Description of PageListener
 *
 * @author student
 */
class PageListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testPictureUrlIsSet()
    {
        $s3Manager = $this->getMockBuilder('AppBundle\Component\S3Manager')->disableOriginalConstructor()->getMock();
        $s3Manager->expects($this->once())->method('getUrlForObject')->with('s3Key')->willReturn('picture_url');
        $page = new Page();
        $page->setS3Key('s3Key');
        $this->assertEmpty($page->getPictureUrl());
        $preSerializeEvent = $this->getMockBuilder('JMS\Serializer\EventDispatcher\PreSerializeEvent')->disableOriginalConstructor()->getMock();
        $preSerializeEvent->expects($this->once())->method('getObject')->willReturn($page);
        $pagelistener = new PageListener($s3Manager);
        $pagelistener->onPreSerialize($preSerializeEvent);
        $this->assertEquals('picture_url', $page->getPictureUrl());

    }
}
