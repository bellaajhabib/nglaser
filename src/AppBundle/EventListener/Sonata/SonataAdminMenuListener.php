<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\EventListener\Sonata;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;

class SonataAdminMenuListener 
{
    /** 
     * @param ConfigureMenuEvent $event
     */
    public function addMenuItems(ConfigureMenuEvent $event)
    {
        $menu = $event->getMenu();

        $child = $menu->getChild('Site')->addChild('setting', ['route' => 'setting_manage']);

        $child->setLabel('Settings');
        
    }
}
