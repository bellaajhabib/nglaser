<?php
namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Setting;
use FOS\RestBundle\Controller\Annotations\View;
use JMS\DiExtraBundle\Annotation\Inject;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\SettingRepository;


/**
 * Description of SettingController
 *
 * @author student
 */
class SettingController extends FOSRestController
{
    /** 
     * @var SettingRepository
     * @Inject("app.repository.setting")
     */
    private $repository;
    
    /** 
     * @ApiDoc(
     *  description="Return Setting detailed Json Response",
     *  requirements={
     *      {
     *       "name"="setting",
     *       "dataType"="integer",
     *       "required"=true, 
     *       "description"="setting id",
     *       "requirement"="\d+"
     *      }
     *  },
     *  output={
     *      "class"="AppBundle\Entity\Setting",
     *      "groups"={"detail"},
     *      "parsers"={
     *          "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *  },     
     *  section="Settings"    
     *  )
     * @ParamConverter("setting", class="AppBundle\Entity\Setting")
     * @View(serializerGroups={"detail", "Default"})
     */
    public function getSettingAction(Setting $setting)
    {
        return $setting;
    }
    
    /** 
     * @ApiDoc(
     *  description="Return a collection of settings",
     *  output={
     *      "class"="AppBundle\Entity\Setting",
     *      "groups"={"list"},
     *      "parsers"={
     *          "Nelmio\ApiDocBundle\Parser\JmsMetadataParser"
     *      }
     *  },
     *  section="Settings"    
     *  )     
     * @View(serializerGroups={"list", "Default"})
     */
    public function getSettingsAction()
    {
        return $this->repository->findAll();
    }
}
