<?php
namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Job;
use FOS\RestBundle\Controller\Annotations\View;
use JMS\DiExtraBundle\Annotation\Inject;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\JobRepository;


/**
 * Description of JobController
 *
 * @author student
 */
class JobController extends FOSRestController
{
    /**
     * @var JobRepository
     * @Inject("app.repository.job")
     */
    private $repository;
    
    /** 
     * @ApiDoc(
     *  description="Return Job detailed Json Response",
     *  requirements={
     *      {
     *       "name"="job",
     *       "dataType"="integer",
     *       "required"=true, 
     *       "description"="job id",
     *       "requirement"="\d+"
     *      }
     *  },
     *  output={
     *      "class"="AppBundle\Entity\Job",
     *      "groups"={"detail"},
     *      "parsers"={
     *          "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *  },     
     *  section="Jobs"    
     *  )
     * @ParamConverter("job", class="AppBundle\Entity\Job")
     * @View(serializerGroups={"detail", "Default"})
     */
    public function getJobAction(Job $job)
    {
        return $job;
    }
    
    
    /** 
     * @ApiDoc(
     *  description="Return a collection of pages",
     *  output={
     *      "class"="AppBundle\Entity\Job",
     *      "groups"={"list"},
     *      "parsers"={
     *          "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *  },
     *  section="Jobs"    
     *  )     
     * @View(serializerGroups={"list", "Default"})
     */
    public function getJobsAction()
    {
        return $this->repository->findBy([],['startDate' => 'desc']);
    }
}
