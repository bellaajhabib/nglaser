<?php
namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Project;
use FOS\RestBundle\Controller\Annotations\View;
use JMS\DiExtraBundle\Annotation\Inject;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\ProjectRepository;


/**
 * Description of ProjectController
 *
 * @author student
 */
class ProjectController 
{
    
    /** 
     * @var ProjectRepository
     * @Inject("app.repository.project")
     */
    private $repository;
    
    /** 
     * @ApiDoc(
     *  description="Return Project detailed Json Response",
     *  requirements={
     *      {
     *       "name"="project",
     *       "dataType"="integer",
     *       "required"=true, 
     *       "description"="project id",
     *       "requirement"="\d+"
     *      }
     *  },
     *  output={
     *      "class"="AppBundle\Entity\Project",
     *      "groups"={"detail"},
     *      "parsers"={
     *          "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *  },     
     *  section="Projects"    
     *  )
     * @ParamConverter("project", class="AppBundle\Entity\Project")
     * @View(serializerGroups={"detail", "Default"})
     */
    public function getProjectAction(Project $project)
    {
        return $project;
    }
    
    /** 
     * @ApiDoc(
     *  description="Return a collection of projects",
     *  output={
     *      "class"="AppBundle\Entity\Project",
     *      "groups"={"list"},
     *      "parsers"={
     *          "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *  },
     *  section="Projects"    
     *  )     
     * @View(serializerGroups={"list", "Default"})
     */
    public function getProjectsAction()
    {
        return $this->repository->findBy([],['position' => 'asc']);
    }
}
