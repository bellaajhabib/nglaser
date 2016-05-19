<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

use AppBundle\Entity\Job;

/**
 * Description of JobDateValidator
 *
 * @author student
 */
class JobDateValidator extends ConstraintValidator
{
    /** 
     * @param Job $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if(null !== $value->getEndDate() && $value->getStartDate() >= $value->getEndDate())
        {
            $this->context->buildViolation($constraint->message)
                ->atPath('startDate')
                ->addViolation();
        }
    }

}
