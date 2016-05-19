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

class CommunityAdmin extends Admin
{
    
    protected $translationDomain = 'AppBundle'; // default is 'messages'

    
    protected $formOptions = ['validation_groups' => ['admin']];
    
    protected $datagridValues = ['_sort_by' => 'position'];
 
    public function configureListFields(ListMapper $list)
    {
        $list->add('title', 'text', ['label' => ''])
             ->add('organization', 'text', ['label' => 'Organization'])
             ->add('url', 'url', ['label' => 'Website'])    
             ->add('startDate', 'datetime', ['label' => 'Start Date', 'date_format' => 'MMM D, YYYY h:mm:ss A'])
             ->add('endDate', 'datetime', ['label' => 'End Date', 'date_format' => 'MMM D, YYYY h:mm:ss A'])
             ->add('position', 'integer', ['label' => 'Position'])
             ->add('_action', 'actions', ['actions' => ['edit' => []]]);
     
    }
    
    public function configureFormFields(FormMapper $form)
    {
        $form->add('title', 'text')
             ->add('organization', 'text')   
             ->add('url', 'url')
             ->add('startDate','sonata_type_date_picker', array('label'=>'Date de prise de fonction','dp_language'=>'fr','format'=>'dd/MM/yyyy'))
             ->add('endDate','sonata_type_date_picker', array('label'=>'Date de prise de fonction','dp_language'=>'fr','format'=>'dd/MM/yyyy'),['required' => false])
             ->add('position', 'integer')
             ->add('description', 'textarea');

    }
    
    public function configureDatagridFilters(DatagridMapper $filter) 
    {
        $filter->add('title')
               ->add('position')
               ->add('startDate')
               ->add('endDate');

    }
}
