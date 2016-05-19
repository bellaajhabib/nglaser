<?php
namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Skill;
use FOS\RestBundle\Controller\Annotations\View;
use JMS\DiExtraBundle\Annotation\Inject;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\SkillRepository;

/**
 * Description of SkillController
 *
 * @author student
 */
class SkillController extends FOSRestController
{
    /** 
     * @var SkillRepository
     * @Inject("app.repository.skill")
     */
    private $repository;
    
    /** 
     * @ApiDoc(
     *  description="Return Skill detailed Json Response",
     *  requirements={
     *      {
     *       "name"="skill",
     *       "dataType"="integer",
     *       "required"=true, 
     *       "description"="skill id",
     *       "requirement"="\d+"
     *      }
     *  },
     *  output={
     *      "class"="AppBundle\Entity\Skill",
     *      "groups"={"detail"},
     *      "parsers"={
     *          "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *  },     
     *  section="Skills"    
     *  )
     * @ParamConverter("skill", class="AppBundle\Entity\Skill")
     * @View(serializerGroups={"detail", "Default"})
     */
    public function getSkillAction(Skill $skill)
    {
        return $skill;
    }
    
    /** 
     * @ApiDoc(
     *  description="Return a collection of skills",
     *  output={
     *      "class"="AppBundle\Entity\Skill",
     *      "groups"={"list"},
     *      "parsers"={
     *          "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *  },
     *  section="Skills"    
     *  )     
     * @View(serializerGroups={"list", "Default"})
     */
    public function getSkillsAction()
    {
        return $this->repository->findBy([], ['type' => 'asc', 'position' => 'asc']);
    }
}
