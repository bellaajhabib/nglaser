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
use Sonata\CoreBundle\Validator\ErrorElement;


class PageAdmin extends Admin
{
    protected $formOptions = ['validation_groups' => []];
    
    public function validate(ErrorElement $errorElement, $object) 
    {
        $errorElement
                ->with('title')
                    ->assertLength([
                        'min' => 3,
                        'max' => 80, 
                        'minMessage' => 'Title must be between 3 to 80 characters long.',
                        'maxMessage' => 'Title must be between 3 to 80 characters long.'
                        ])
                    ->assertNotBlank(['message' => 'Title can not be blank.'])
                ->end()
                ->with('description')
                    ->assertLength([
                        'min' => 25,
                        'max' => 10000, 
                        'minMessage' => 'Description length must be between 25 to 10,000 characters long.',
                        'maxMessage' => 'Description length must be between 25 to 10,000 characters long.'
                        ])
                    ->assertNotBlank(['message' => 'Description can not be blank.'])
                ->end();                
                
        if(empty($object->getS3Key())) {
            $errorElement->with('picture')
                    ->assertImage([
                        'allowPortrait' => false,
                        'mimeTypes' => ["image/jpeg","image/png"],
                        'mimeTypesMessage' => 'The file must be a png or jpg'
                    ])
                    ->assertNotBlank(['message' => 'You must fill in an image.'])
                ->end();
        }

    }
    
    public function configureListFields(ListMapper $list)
    {
        $list->add('title', 'text', ['label' => 'Page Title'])
             ->add('picture', 'text', ['label' => 'Page Picture', 'template' => 'AppBundle:Admin:picture_template.html.twig'])
             ->add('_action', 'actions', ['actions' => ['edit' => []]]);
    }
    
    public function configureFormFields(FormMapper $form)
    {
        $form->add('title', 'text')
             ->add('description', 'textarea')
             ->add('picture', 'file', ['required' => false]);

    }
    
    public function configureDatagridFilters(DatagridMapper $filter) 
    {
        $filter->add('title');
    }
    
    public function configure() 
    {
        $this->setTemplate('list', 'AppBundle:Admin:page_list.html.twig');
    }
}
