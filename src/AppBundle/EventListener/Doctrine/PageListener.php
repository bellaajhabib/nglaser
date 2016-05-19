<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\EventListener\Doctrine;
/**
 * Description of PageSubscriber
 *
 * @author student
 */
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use AppBundle\Entity\Page;
use AppBundle\Component\S3Manager;
use AppBundle\Helper\StringHelper;
use JMS\DiExtraBundle\Annotation as JMS;

/**
 * @JMS\DoctrineListener(
 *     events = {"prePersist", "preUpdate", "postPremove"},
 *     connection = "default",
 *     lazy = true,
 *     priority = 0,
 * )
 * 
 */
class PageListener
{
    /**
     * @var S3Manager 
     */
    private $s3Manager;
    
    /** 
     * @var StringHelper
     */
    private $stringHelper;
    
    /**
     * @JMS\InjectParams({
     *     "s3Manager" = @JMS\Inject("app.component.s3manager"),
     *     "stringHelper"     = @JMS\Inject("app.helper.stringhelper"), 
     * })
     */
    public function __construct(S3Manager $s3Manager, StringHelper $stringHelper) 
    {
        $this->s3Manager = $s3Manager;
        $this->stringHelper = $stringHelper;
    }

    public function prePersist(LifecycleEventArgs $event) 
    {
        $page = $event->getObject();
        if($page instanceof Page) {
            $key =  $this->s3Manager->upload($page->getPicture());
            $page->setS3Key($key);
            $this->updateSlug($page);
        }
    }
    
    public function preUpdate(LifecycleEventArgs $event) 
    {
        $page = $event->getObject();
        if($page instanceof Page && !empty($page->getPicture())) {
            $this->s3Manager->removeObjectFromS3($page->getS3Key());
            $page->setS3Key($this->s3Manager->upload($page->getPicture()));
        }
        
        if($page instanceof Page) {
            $this->updateSlug($page);
        }
    }
    
    private function updateSlug(Page $page) 
    {
        $page->setSlug($this->stringHelper->simpleSlug($page->getTitle()));
    }
    
    public function postRemove(LifecycleEventArgs $event) 
    {
        $page = $event->getObject();
        if($page instanceof Page) {
            $this->s3Manager->removeObjectFromS3($page->getS3Key());
        }
    }
}
