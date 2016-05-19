<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Route\RouteCollection;

class SettingAdmin extends Admin
{
    protected $baseRouteName = 'setting';
    
    protected $baseRoutePattern = 'setting';
    
    public function configureRoutes(RouteCollection $collection)
    {
        $collection->clear();
        $collection->add("manage");
    }
    
    public function configure() 
    {
        $this->setTemplate('manage',  'AppBundle:Admin:setting.html.twig');
    }
}
