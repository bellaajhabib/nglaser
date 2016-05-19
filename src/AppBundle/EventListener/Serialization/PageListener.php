<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\EventListener\Serialization;

use JMS\DiExtraBundle\Annotation as JMS;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;
use AppBundle\Component\S3Manager;
use AppBundle\Entity\Page;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;

/** 
 * @JMS\Service("app.serialize.page")
 * @JMS\Tag("jms_serializer.event_subscriber")
 */
class PageListener implements EventSubscriberInterface
{
    /** 
     * @var S3Manager
     */
    private $s3Manager;
    
    /**
     * @JMS\InjectParams({
     *     "s3Manager" = @JMS\Inject("app.component.s3manager")
     * })
     */
    public function __construct(S3Manager $s3Manager)
    {
        $this->s3Manager = $s3Manager;
    }
    
    /**
     * @inheritdoc
     */
    static public function getSubscribedEvents()
    {
        return [
            ['event' => 'serializer.pre_serialize', 'class' => 'AppBundle\Entity\Page', 'method' => 'onPreSerialize']
        ];
    }
    
    public function onPreSerialize(PreSerializeEvent $event)
    {
        $object = $event->getObject();
        if($object instanceof  Page) {
            $object->setPictureUrl($this->s3Manager->getUrlForObject($object->getS3Key()));
        }
        
    }
}
