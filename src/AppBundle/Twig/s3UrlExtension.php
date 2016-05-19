<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Twig;

use AppBundle\Component\S3Manager;
use JMS\DiExtraBundle\Annotation as JMS;

/**
 * Description of s3UrlExtension
 * @JMS\Service("app.twig.s3",  public=true)
 * @JMS\Tag("twig.extension")
 * @author student
 */
class s3UrlExtension extends \Twig_Extension
{
    /** 
     * @var S3Manager 
     */
    private $s3;
    
    /**
     * @JMS\InjectParams({
     *     "s3" = @JMS\Inject("app.component.s3manager") 
     * })
     */
    public function __construct(S3Manager $s3)
    {
        $this->s3 = $s3;
    }
    
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('s3Url', [$this, 's3UrlFilter']),
        ];
    }

    public function s3UrlFilter($key)
    {
        return $this->s3->getUrlForObject($key);
    }

    public function getName()
    {
        return 's3_url_extension';
    }
}
