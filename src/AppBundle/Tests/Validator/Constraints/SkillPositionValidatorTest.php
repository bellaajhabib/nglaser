<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Tests\Validator\Constraints;

use AppBundle\Validator\Constraints\SkillPosition;
use AppBundle\Validator\Constraints\SkillPositionValidator;
 
/**
 * Description of SkillPositionValidatorTest
 *
 * @author student
 */
class SkillPositionValidatorTest extends \PHPUnit_Framework_TestCase
{
    
    public function testDuplicatePositionWithSameType()
    {
        $context = $this->getMockBuilder('Symfony\Component\Validator\Context\ExecutionContext')
            ->disableOriginalConstructor()
            ->setMethods(['buildViolation', 'atPath', 'addViolation'])
            ->getMock();
        $builder = $this->getMockBuilder('Symfony\Component\Validator\Violation\ConstraintViolationBuilder')
            ->disableOriginalConstructor()
            ->setMethods(['addViolation'])
            ->getMock();
        $context->expects($this->once())->method('buildViolation')->with('You can not choose a duplicate position for the type.')->willReturn($context);
        $context->expects($this->once())->method('atPath')->with('position')->willReturn($builder);
        $builder->expects($this->once())->method('addViolation');
        
        $skillRepository = $this->getMockBuilder('AppBundle\Entity\SkillRepository')->disableOriginalConstructor()->setMethods(['findAll'])->getMock();
        $skillRepository->expects($this->once())
                    ->method('findAll')
                    ->willReturn($this->buildListOfPositions([
                        ['id' => 1, 'position' => 3, 'type' => 'frontend'],
                        ['id' => 2, 'position' => 4, 'type' => 'frontend'],
                        ['id' => 3, 'position' => 5, 'type' => 'framework'],
                        ['id' => 4, 'position' => 33,'type' => 'framework'],
                        ]));
        $skillValue = $this->buildSkillPosition(5,'frontend', 3);
        $skillConstraint = new SkillPosition([]);
        $skillValidator = new SkillPositionValidator($skillRepository);
        $skillValidator->initialize($context);
        $skillValidator->validate($skillValue, $skillConstraint);

    }
    
    
    public function testDuplicatePositionDifferentTypeNoValidation()
    {
        $context = $this->getMockBuilder('Symfony\Component\Validator\Context\ExecutionContext')
            ->disableOriginalConstructor()
            ->setMethods(['buildViolation', 'atPath', 'addViolation'])
            ->getMock();
        $context->expects($this->never())->method('buildViolation');
        $skillRepository = $this->getMockBuilder('AppBundle\Entity\SkillRepository')->disableOriginalConstructor()->setMethods(['findAll'])->getMock();
        $skillRepository->expects($this->once())
                    ->method('findAll')
                    ->willReturn($this->buildListOfPositions([
                        ['id' => 1, 'position' => 3, 'type' => 'frontend'],
                        ['id' => 2, 'position' => 4, 'type' => 'frontend'],
                        ['id' => 3, 'position' => 5, 'type' => 'framework'],
                        ['id' => 4, 'position' => 33,'type' => 'framework'],
                        ]));
        $skillValue = $this->buildSkillPosition(5,'platform', 3);
        $skillConstraint = new SkillPosition([]);
        $skillValidator = new SkillPositionValidator($skillRepository);
        $skillValidator->initialize($context);
        $skillValidator->validate($skillValue, $skillConstraint);
    }
    
    public function buildListOfPositions($listOfSkills)
    {
        $skillListReturn = [];
        foreach($listOfSkills as $skill) 
        {
            $skillListReturn[] = $this->buildSkillPosition($skill['id'], $skill['type'], $skill['position']);
        }
        return $skillListReturn;
    }
    
    public function buildSkillPosition($id, $type, $position) 
    {
        $skill = $this->getMockBuilder('AppBundle\Entity\Skill')->disableOriginalConstructor()->getMock();
        $skill->expects($this->any())->method('getId')->willReturn($id);
        $skill->expects($this->any())->method('getPosition')->willReturn($position);
        $skill->expects($this->any())->method('getType')->willReturn($type);
        return $skill;
    }
}
