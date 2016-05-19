<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Controller\Api;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Page;
use FOS\RestBundle\Controller\Annotations\View;
use JMS\DiExtraBundle\Annotation\Inject;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\PageRepository;
use FOS\RestBundle\Controller\Annotations\Route;



/**
 * Description of PageController
 *
 * @author student
 */
class PageController extends FOSRestController
{

    /**
     * @var PageRepository 
     * @Inject("app.repository.page")
     */
    private $repository;


    /** 
     * @ApiDoc(
     *  description="Return Page detailed Json Response",
     *  requirements={
     *      {
     *       "name"="slug",
     *       "dataType"="string",
     *       "required"=true, 
     *       "description"="Page's slug"
     *      }
     *  },
     *  output={
     *      "class"="AppBundle\Entity\Page",
     *      "groups"={"detail"},
     *      "parsers"={
     *          "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *  },     
     *  section="Pages"    
     *  )
     * @View(serializerGroups={"detail", "Default"})
     */
    public function getPageAction($slug)
    {
        return $this->repository->findOneBy(['slug' => $slug]);
    }
    
    /** 
     * @ApiDoc(
     *  description="Return a collection of pages",
     *  output={
     *      "class"="AppBundle\Entity\Page",
     *      "groups"={"list"},
     *      "parsers"={
     *          "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *  },
     *  section="Pages"    
     *  )     
     * @View(serializerGroups={"list", "Default"})
     */
    public function getPagesAction()
    {
        return $this->repository->findAll();
    }
    
}
