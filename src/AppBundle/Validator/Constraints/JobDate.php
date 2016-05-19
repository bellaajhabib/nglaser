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
class JobDate extends Constraint
{
    public $message = "Your start date must be before the end date.";
    
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
