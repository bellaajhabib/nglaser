<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Helper;

use JMS\DiExtraBundle\Annotation as JMS;

/**
 * Description of S3Manager
 * @JMS\Service("app.helper.stringhelper")
 * @author student
 */
class StringHelper 
{
    
    public function randomString()
    {
        return md5(uniqid());
    }
    
    public function simpleSlug($title) 
    {
        return strtolower(str_replace(' ', '-', $title));
    }
    
}
