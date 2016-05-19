<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Setting;

/**
 * Description of LoadSettingData
 *
 * @author student
 */
class LoadSettingData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface 
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $setting1 = new Setting();
        $setting1->setName('city');
        $setting1->setValue('Austin');
        $manager->persist($setting1);        
        
        $setting2 = new Setting();
        $setting2->setName('state');
        $setting2->setValue('Texas');
        $manager->persist($setting2);        
        
        $setting3 = new Setting();
        $setting3->setName('email');
        $setting3->setValue('glaserpower@gmail.com');
        $manager->persist($setting3);        

        $setting4 = new Setting();
        $setting4->setName('name');
        $setting4->setValue('Noah Glaser');
        $manager->persist($setting4);        

       
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
