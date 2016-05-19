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

class ProjectAdmin extends Admin
{
    
    protected $formOptions = ['validation_groups' => ['admin']];
    
    protected $datagridValues = ['_sort_by' => 'position'];
    
    public function configureListFields(ListMapper $list)
    {
        $list->add('name', 'text', ['label' => 'Name'])
             ->add('url', 'url', ['label' => 'Project Url'])
             ->add('position', 'integer', ['label' => 'Position'])
             ->add('_action', 'actions', ['actions' => ['edit' => []]]);
     
    }
    
    public function configureFormFields(FormMapper $form)
    {
        $form->add('name', 'text')
             ->add('url', 'url')
             ->add('position', 'integer')
             ->add('description', 'textarea');

    }
    
    public function configureDatagridFilters(DatagridMapper $filter) 
    {
        $filter->add('name')
               ->add('position');
    }
}
