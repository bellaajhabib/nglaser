<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Tests\Validator\Constraints;

use AppBundle\Validator\Constraints\JobDateValidator;
use AppBundle\Validator\Constraints\JobDate;
use AppBundle\Entity\Job;

/**
 * Description of JobDateValidatorTest
 *
 * @author student
 */
class JobDateValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testStartDateGreaterThanEndDate()
    {
        $context = $this->getMockBuilder('Symfony\Component\Validator\Context\ExecutionContext')
            ->disableOriginalConstructor()
            ->setMethods(['buildViolation', 'atPath', 'addViolation'])
            ->getMock();
        $builder = $this->getMockBuilder('Symfony\Component\Validator\Violation\ConstraintViolationBuilder')
            ->disableOriginalConstructor()
            ->setMethods(array('addViolation'))
            ->getMock();

        $context->expects($this->once())->method('buildViolation')->with('Your start date must be before the end date.')->willReturn($context);
        $context->expects($this->once())->method('atPath')->with('startDate')->willReturn($builder);
        $builder->expects($this->once())->method('addViolation');
        $jobDateValidator = new JobDateValidator();
        $jobDateValidator->initialize($context);
        $job = new Job();
        $job->setStartDate(new \DateTime('+5 months'));
        $job->setEndDate(new \DateTime());
        $constraint = new JobDate([]);
        $jobDateValidator->validate($job, $constraint);
    }
    
    public function testEndDateNullDoesNotGiveError()
    {
        $context = $this->getMockBuilder('Symfony\Component\Validator\Context\ExecutionContext')
            ->disableOriginalConstructor()
            ->setMethods(['buildViolation', 'atPath', 'addViolation'])
            ->getMock();
        $context->expects($this->never())->method('buildViolation');
        $jobDateValidator = new JobDateValidator();
        $jobDateValidator->initialize($context);
        $job = new Job();
        $job->setStartDate(new \DateTime('+5 months'));
        $constraint = new JobDate([]);
        $jobDateValidator->validate($job, $constraint);
    }

    protected function createValidator() 
    {
        return new JobDateValidator();
    }

}
