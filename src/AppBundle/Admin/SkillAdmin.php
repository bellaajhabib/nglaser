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


/**
 * Description of SkillAdmin
 *
 * @author student
 */
class SkillAdmin extends Admin
{
    protected $formOptions = ['validation_groups' => ['admin']];
    
    public function configureListFields(ListMapper $list)
    {
        $list->add('name', 'text', ['label' => 'Skill Title'])
             ->add('level', 'integer', ['label' => 'SKill Level'])
             ->add('position', 'integer', ['label' => 'Position'])  
             ->add('type', 'text', ['label' => 'Type'])   
             ->add('_action', 'actions', ['actions' => ['edit' => []]]);
    }
    
    public function configureFormFields(FormMapper $form)
    {
        $form->add('name', 'text', ['label' => 'Skill Title'])
             ->add('level', 'integer', ['label' => 'SKill Level', 'attr' => ['min' => 1, 'max' => 5]])
             ->add('position', 'integer', ['label' => 'Position', 'attr' => ['min' => 1, 'max' => 20]])  
             ->add('type', 'choice', ['label' => 'Type', 'choices' => [
                 'Language'  => 'Language',
                 'PHP Frameworks'  => 'PHP Frameworks',
                 'Symfony Bundles'     => 'Symfony Bundles',
                 'Javascript Libraries'   => 'Javascript Libraries',
                 'Javascript Frameworks' => 'Javascript Frameworks',
                 'Databases'  => 'Databases',
                 'General Frontend' => 'General Frontend',
                 'General Web Dev' => 'General Web Dev'
             ]]);   
    }
    
    public function configureDatagridFilters(DatagridMapper $filter) 
    {
        $filter->add('name')->add('position')->add('type');
    }

}
