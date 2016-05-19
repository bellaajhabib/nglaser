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

class JobAdmin extends Admin
{
    
    protected $formOptions = ['validation_groups' => ['admin']];
    
    public function configureListFields(ListMapper $list)
    {
        $list->add('company', 'text', ['label' => 'Compnay'])
             ->add('title', 'text', ['label' => 'Title'])
             ->add('startDate', 'datetime', ['label' => 'Start Date', 'format' => 'm/d/Y'])
             ->add('endDate', 'datetime', ['label' => 'End Date', 'format' => 'm/d/Y'])
             ->add('_action', 'actions', ['actions' => ['edit' => []]]);
    
    }
    
    public function configureFormFields(FormMapper $form)
    {
        $form->add('company', 'text')
             ->add('title', 'text')
             ->add('description', 'textarea')
             ->add('startDate', 'sonata_type_date_picker')
             ->add('endDate', 'sonata_type_date_picker');

    }
    
    public function configureDatagridFilters(DatagridMapper $filter) 
    {
        $filter->add('title')
               ->add('company')
               ->add('startDate')
               ->add('endDate');
    }
}
