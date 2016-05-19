<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class UserAdmin extends Admin
{
    
    protected $baseRouteName = 'user';
    
    protected $baseRoutePattern = 'user';
    
    protected $formOptions = ['validation_groups' => ['admin']];
    
    public function configureListFields(ListMapper $list)
    {
        $list->add('id', 'integer', ['label' => 'User Id'])
             ->add('email', 'text', ['label' => 'Email Address'])
             ->add('reset_password', 'string', ['template' => 'AppBundle:Admin:user_reset_password.html.twig', 'label' => 'Reset Password']);

    }
    
    public function prePersist($object) 
    {
        $this->getConfigurationPool()->getContainer()->get('app.component.usermanager')->setNewUser($object);
    }
    
    public function postPersist($object)
    {
        $this->getConfigurationPool()->getContainer()->get('app.component.usermanager')->sendNewUserEmail($object);
    }
    
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('reset_password', 'reset_password/{id}');
        $collection->remove('edit');
    }
    
    public function configureFormFields(FormMapper $form)
    {
        $form->add('email');
    }
    
    public function configureDatagridFilters(DatagridMapper $filter) 
    {
        $filter->add('email')->add('id');
    }
}
