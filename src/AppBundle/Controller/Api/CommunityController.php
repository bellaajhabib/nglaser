<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Community;
use FOS\RestBundle\Controller\Annotations\View;
use JMS\DiExtraBundle\Annotation\Inject;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\CommunityRepository;
use FOS\RestBundle\Controller\Annotations\Route;

/**
 * Description of CommunityController
 *
 * @author student
 */
class CommunityController extends FOSRestController
{
    /**
     * @var CommunityRepository
     * @Inject("app.repository.community")
     */
    private $repository;
    
    /** 
     * @ApiDoc(
     *  description="Return Community detailed Json Response",
     *  requirements={
     *      {
     *       "name"="community",
     *       "dataType"="integer",
     *       "required"=true, 
     *       "description"="community id",
     *       "requirement"="\d+"
     *      }
     *  },
     *  output={
     *      "class"="AppBundle\Entity\Community",
     *      "groups"={"detail"},
     *      "parsers"={
     *          "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *  },     
     *  section="Community"    
     *  )     
     * @ParamConverter("community", class="AppBundle\Entity\Community")
     * @View(serializerGroups={"detail", "Default"})
     */
    public function getCommunityAction(Community $community)
    {
        return $community;
    }
    
    /** 
     * @ApiDoc(
     *  description="Return a Collection Community Json Response",
     *  output={
     *      "class"="AppBundle\Entity\Community",
     *      "groups"={"list"},
     *      "parsers"={
     *          "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *  }, 
     *  section="Community"    
     *  )      
     * @View(serializerGroups={"list"})
     */
    public function getCommunitiesAction()
    {
        return $this->repository->findBy([],['startDate' => 'desc']);
    }

}
