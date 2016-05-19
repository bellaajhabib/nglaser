<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class SkillPosition extends Constraint
{
    public $message = 'You can not choose a duplicate position for the type.';
    
    public function validatedBy() 
    {
        return 'skill_position_duplicate_validator';
    }
    
    public function getTargets() 
    {
       return Constraint::CLASS_CONSTRAINT;
    }
}
