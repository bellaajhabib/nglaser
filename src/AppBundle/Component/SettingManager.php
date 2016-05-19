<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Component;

use AppBundle\Entity\AdminObject\Setting as FormSetting;
use AppBundle\Entity\SettingRepository;
use AppBundle\Entity\Setting;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as JMS;


/**
 * Description of S3Manager
 * @JMS\Service("app.component.settingmanager")
 * @author student
 */
class SettingManager 
{
    private $em;
    
    private $settingRepository;
    
    /**
     * @JMS\InjectParams({
     *     "settingRepository"  = @JMS\Inject("app.repository.setting"),
     *     "em" = @JMS\Inject("doctrine.orm.entity_manager")
     * })
     */
    public function __construct(SettingRepository $settingRepository, EntityManager $em) 
    {
        $this->em = $em;
        $this->settingRepository = $settingRepository;
    }
    
    public function getSettingFormObject()
    {
        $formSettingObject = new FormSetting();
        $settings = $this->settingRepository->findAll();
        foreach($settings as $setting)
        {
            if($setting->getName() === 'name') 
            {
                $formSettingObject->setName($setting->getValue());
            }
            
            if($setting->getName() === 'city') 
            {
                $formSettingObject->setCity($setting->getValue());
            }
            
            if($setting->getName() === 'state')
            {
                $formSettingObject->setState($setting->getValue());
            }
            
            if($setting->getName() === 'email')
            {
                $formSettingObject->setEmail($setting->getValue());
            }
        }
        
        return $formSettingObject;
    }
    
    public function saveSettings(FormSetting $settingObj)
    {
        if($city = $this->settingRepository->findOneBy(['name' => 'city'])) {
            $this->updateSetting($city, $settingObj->getCity());
        }
        else {
            $this->createSetting('city', $settingObj->getCity());
        }
        
        if($state = $this->settingRepository->findOneBy(['name' => 'state'])) {
            $this->updateSetting($state, $settingObj->getState());
        }
        else {
            $this->createSetting('state', $settingObj->getState());
        }
        
        if($name = $this->settingRepository->findOneBy(['name' => 'name'])) {
            $this->updateSetting($name, $settingObj->getName());
        }
        else {
            $this->createSetting('name', $settingObj->getName());
        }
        
        if($email = $this->settingRepository->findOneBy(['name' => 'email'])) {
            $this->updateSetting($email, $settingObj->getEmail());
        }
        else {
            $this->createSetting('email', $settingObj->getEmail());
        }
    }
    
    
    
    public function createSetting($name, $value)
    {
        $setting = new Setting();
        $setting->setName($name)->setValue($value);
        $this->em->persist($setting);
        $this->em->flush();
    }
    
    public function updateSetting(Setting $setting, $newValue) 
    {
        $setting->setValue($newValue);
        $this->em->persist($setting);
        $this->em->flush();
    }
}
