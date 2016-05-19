<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Tests\Component;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use AppBundle\Component\SettingManager;
use AppBundle\Entity\AdminObject\Setting as FormSetting;

/**
 * Description of SettingManagerTest
 *
 * @author student
 */
class SettingManagerTest extends WebTestCase
{
    /** 
     * @var SettingManager
     */
    private $settingManager;
    
    public function setUp()
    {
        parent::setUp();
        $this->loadFixtures(['AppBundle\DataFixtures\ORM\LoadSettingData']);

        // you can now run your functional tests with a populated database
        $this->settingManager = $this->getContainer()->get('app.component.settingmanager');

    }
    
    public function testGetFormObject()
    {
        $formObject = $this->settingManager->getSettingFormObject();
        $this->assertEquals('Austin', $formObject->getCity());
        $this->assertEquals('Texas', $formObject->getState());
        $this->assertEquals('Noah Glaser', $formObject->getName());
        $this->assertEquals('glaserpower@gmail.com', $formObject->getEmail());
    }
    
    public function testSaveSetting()
    {
        $formObject = new FormSetting();
        $formObject->setCity('Nashville');
        $formObject->setState('Tennessee');
        $formObject->setEmail('noah.glaser@hotmail.com');
        $formObject->setName('Bill Smith');
        $this->settingManager->saveSettings($formObject);
        $settingRepo = $this->getContainer()->get("app.repository.setting");
       
        $email = $settingRepo->findOneBy(['name' => 'email']);
        $this->assertEquals('noah.glaser@hotmail.com', $email->getValue());
        
        $name = $settingRepo->findOneBy(['name' => 'name']);
        $this->assertEquals('Bill Smith', $name->getValue());
        
        $state = $settingRepo->findOneBy(['name' => 'state']);
        $this->assertEquals('Tennessee', $state->getValue());
        
        $city = $settingRepo->findOneBy(['name' => 'city']);
        $this->assertEquals('Nashville', $city->getValue());
    }
}
