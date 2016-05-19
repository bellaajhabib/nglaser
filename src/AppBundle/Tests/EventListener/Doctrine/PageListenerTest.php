<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Tests\EventListener\Doctrine;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use AppBundle\Helper\StringHelper;
use AppBundle\EventListener\Doctrine\PageListener;
 

/**
 * Description of PageListenerTest
 *
 * @author student
 */
class PageListenerTest extends WebTestCase
{
    
    public function testPrePersistUploadIsCalled()
    {
        $s3Manager = $this->getMockBuilder('AppBundle\Component\S3Manager')->disableOriginalConstructor()->getMock();
        
        $uploadedFile = $this->getMockBuilder('Symfony\Component\HttpFoundation\File\UploadedFile')->disableOriginalConstructor()->getMock();
        
        $page = $this->getMockBuilder('AppBundle\Entity\Page')->disableOriginalConstructor()->getMock();
        $page->expects($this->once())->method('getPicture')->willReturn($uploadedFile);
        
        $s3Manager->expects($this->once())->method('upload')->with($uploadedFile);
        
        $lifeCycleListener = $this->getMockBuilder('Doctrine\Common\Persistence\Event\LifecycleEventArgs')->disableOriginalConstructor()->getMock();
        $lifeCycleListener->expects($this->once())->method('getObject')->willReturn($page);
        
        $pageListener = new PageListener($s3Manager, new StringHelper());
        $pageListener->prePersist($lifeCycleListener);
    }
    
    public function testPreUpdateRemoveAndUploadAreCalled()
    {
        $s3Manager = $this->getMockBuilder('AppBundle\Component\S3Manager')->disableOriginalConstructor()->getMock();
        
        $uploadedFile = $this->getMockBuilder('Symfony\Component\HttpFoundation\File\UploadedFile')->disableOriginalConstructor()->getMock();
        
        $page = $this->getMockBuilder('AppBundle\Entity\Page')->disableOriginalConstructor()->getMock();
        $page->expects($this->exactly(2))->method('getPicture')->willReturn($uploadedFile);
        $page->expects($this->any())->method('getS3Key')->willReturn('this_is_old_key');

        $s3Manager->expects($this->once())->method('upload')->with($uploadedFile)->willReturn('this_is_new_key');
        $s3Manager->expects($this->once())->method('removeObjectFromS3')->with('this_is_old_key');
        $page->expects($this->once())->method('setS3Key')->with('this_is_new_key');
        
        $lifeCycleListener = $this->getMockBuilder('Doctrine\Common\Persistence\Event\LifecycleEventArgs')->disableOriginalConstructor()->getMock();
        $lifeCycleListener->expects($this->once())->method('getObject')->willReturn($page);
        
        $pageListener = new PageListener($s3Manager, new StringHelper());
        $pageListener->preUpdate($lifeCycleListener);
    }
    
    public function testPreUpdateWhenNoPictureIsUploaded() 
    {
        $s3Manager = $this->getMockBuilder('AppBundle\Component\S3Manager')->disableOriginalConstructor()->getMock();
                
        $page = $this->getMockBuilder('AppBundle\Entity\Page')->disableOriginalConstructor()->getMock();
        $page->expects($this->once())->method('getPicture')->willReturn(null);
        $page->expects($this->never())->method('getS3Key');

        $s3Manager->expects($this->never())->method('upload');
        $s3Manager->expects($this->never())->method('removeObjectFromS3');
        
        $lifeCycleListener = $this->getMockBuilder('Doctrine\Common\Persistence\Event\LifecycleEventArgs')->disableOriginalConstructor()->getMock();
        $lifeCycleListener->expects($this->once())->method('getObject')->willReturn($page);
        
        $pageListener = new PageListener($s3Manager, new StringHelper());
        $pageListener->preUpdate($lifeCycleListener);
    }
    
    public function testPostRemoveTestRemoveObjectIsCalled()
    {
        $s3Manager = $this->getMockBuilder('AppBundle\Component\S3Manager')->disableOriginalConstructor()->getMock();
                
        $page = $this->getMockBuilder('AppBundle\Entity\Page')->disableOriginalConstructor()->getMock();
        $page->expects($this->once())->method('getS3Key')->willReturn('this_is_old_key');
        
        $lifeCycleListener = $this->getMockBuilder('Doctrine\Common\Persistence\Event\LifecycleEventArgs')->disableOriginalConstructor()->getMock();
        $lifeCycleListener->expects($this->once())->method('getObject')->willReturn($page);
        $s3Manager->expects($this->once())->method('removeObjectFromS3')->with('this_is_old_key');

        $pageListener = new PageListener($s3Manager, new StringHelper());
        $pageListener->postRemove($lifeCycleListener);
    }
    
    public function testPrePersistSlugIsSet()
    {
        $s3Manager = $this->getMockBuilder('AppBundle\Component\S3Manager')->disableOriginalConstructor()->getMock();
        
        $uploadedFile = $this->getMockBuilder('Symfony\Component\HttpFoundation\File\UploadedFile')->disableOriginalConstructor()->getMock();
        
        $page = $this->getMockBuilder('AppBundle\Entity\Page')->disableOriginalConstructor()->getMock();
        $page->expects($this->once())->method('getPicture')->willReturn($uploadedFile);
        $page->expects($this->once())->method('getTitle')->willReturn('Home Page');
        $page->expects($this->once())->method('setSlug')->with('home-page');        
        $s3Manager->expects($this->once())->method('upload')->with($uploadedFile);
        
        $lifeCycleListener = $this->getMockBuilder('Doctrine\Common\Persistence\Event\LifecycleEventArgs')->disableOriginalConstructor()->getMock();
        $lifeCycleListener->expects($this->once())->method('getObject')->willReturn($page);
        
        $pageListener = new PageListener($s3Manager, new StringHelper());
        $pageListener->prePersist($lifeCycleListener);
    }
    
    public function testPreUpdateSlugIsSet() 
    {
        $s3Manager = $this->getMockBuilder('AppBundle\Component\S3Manager')->disableOriginalConstructor()->getMock();
                
        $page = $this->getMockBuilder('AppBundle\Entity\Page')->disableOriginalConstructor()->getMock();
        $page->expects($this->once())->method('getPicture')->willReturn(null);
        $page->expects($this->never())->method('getS3Key');
        $page->expects($this->once())->method('getTitle')->willReturn('COOL MOOSE is');
        $page->expects($this->once())->method('setSlug')->with('cool-moose-is');        

        $s3Manager->expects($this->never())->method('upload');
        $s3Manager->expects($this->never())->method('removeObjectFromS3');
        
        $lifeCycleListener = $this->getMockBuilder('Doctrine\Common\Persistence\Event\LifecycleEventArgs')->disableOriginalConstructor()->getMock();
        $lifeCycleListener->expects($this->once())->method('getObject')->willReturn($page);
        
        $pageListener = new PageListener($s3Manager, new StringHelper());
        $pageListener->preUpdate($lifeCycleListener);

    }
    
}
