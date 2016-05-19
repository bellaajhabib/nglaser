<?php
namespace AppBundle\Controller\Admin;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Controller\CRUDController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Description of SettingController
 *
 * @author student
 */
class SettingController extends CRUDController
{
 

    
    public function manageAction(Request $request)
    {
        $settingManager = $this->container->get('app.component.settingmanager');
        $settingObj = $settingManager->getSettingFormObject();
        $settings  = $this->createForm('setting', $settingObj);
        if($request->isMethod('POST')) {
             $settings->handleRequest($request);
             if($settings->isValid()) {
                 $settingManager->saveSettings($settings->getData());
                 $request->getSession()->getFlashBag()->add('message', 'Setting Sucessfully Save.');
             }
             else {
                $request->getSession()->getFlashBag()->add('message', 'Please fix the form.');
             }
        }
        return $this->render($this->admin->getTemplate('manage'), ['action' => 'manage' , 'setting' => $settings->createView()]);
    }
}
