<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Admin\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;

class SettingBlock extends BaseBlockService
{
    public function setDefaultSettings(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults([
            'title'    => 'Welcome To The Admin',
            'template' => 'AppBundle:Admin:dashboard.html.twig',
        ]);
    }
    
    

}