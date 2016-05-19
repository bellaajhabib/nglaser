<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Tests\Validator\Constraints;

use AppBundle\Validator\Constraints\ProjectPositionDuplicate;
use AppBundle\Validator\Constraints\PositionDuplicateValidator;

/**
 * Description of PositionDuplicateValidatorTest
 *
 * @author student
 */
class PositionDuplicateValidatorTest extends \PHPUnit_Framework_TestCase 
{
    public function testDuplicatePositionValidation()
    {
        $context = $this->getMockBuilder('Symfony\Component\Validator\Context\ExecutionContext')
            ->disableOriginalConstructor()
            ->setMethods(['buildViolation', 'atPath', 'addViolation'])
            ->getMock();
        $builder = $this->getMockBuilder('Symfony\Component\Validator\Violation\ConstraintViolationBuilder')
            ->disableOriginalConstructor()
            ->setMethods(['addViolation'])
            ->getMock();

        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')->disableOriginalConstructor()->setMethods(['findAll'])->getMock();
        $repository->expects($this->once())
                    ->method('findAll')
                    ->willReturn($this->buildListPosition([
                        ['id' => 1, 'position' => 3],
                        ['id' => 2, 'position' => 4],
                        ['id' => 3, 'position' => 5],
                        ['id' => 4, 'position' => 33],
                        ]));
        $positionValue = $this->buildPosition(5, 33);
        $context->expects($this->once())->method('buildViolation')->with('The position is already taken, please choose another option.')->willReturn($context);
        $context->expects($this->once())->method('atPath')->with('position')->willReturn($builder);
        $builder->expects($this->once())->method('addViolation');
        $positionDuplicateValidator = new PositionDuplicateValidator($repository);
        $positionDuplicateValidator->initialize($context);
        $constraint = new ProjectPositionDuplicate([]);
        $positionDuplicateValidator->validate($positionValue, $constraint);
    }
    
    public function testDuplicateSameIdInFindNoTriggerValidation()
    {
                
        $context = $this->getMockBuilder('Symfony\Component\Validator\Context\ExecutionContext')
            ->disableOriginalConstructor()
            ->setMethods(['buildViolation', 'atPath', 'addViolation'])
            ->getMock();
        $repository = $this->getMockBuilder('Doctrine\ORM\EntityRepository')->disableOriginalConstructor()->setMethods(['findAll'])->getMock();
        $repository->expects($this->once())
                    ->method('findAll')
                    ->willReturn($this->buildListPosition([
                        ['id' => 1, 'position' => 3],
                        ['id' => 2, 'position' => 4],
                        ['id' => 3, 'position' => 5],
                        ['id' => 4, 'position' => 33],
                        ]));
        $positionValue = $this->buildPosition(33, 4);
        $context->expects($this->never())->method('buildViolation');
        $positionDuplicateValidator = new PositionDuplicateValidator($repository);
        $positionDuplicateValidator->initialize($context);
        $constraint = new ProjectPositionDuplicate([]);
        $positionDuplicateValidator->validate($positionValue, $constraint);

    }
    
    public function buildPosition($position, $id)
    {
        $positionMock = $this->getMockBuilder('AppBundle\Entity\PositionInterface')->disableOriginalConstructor()->getMock();
        $positionMock->expects($this->any())->method('getId')->willReturn($id);
        $positionMock->expects($this->any())->method('getPosition')->willReturn($position);
        return $positionMock;
    }
    
    public function buildListPosition($listOfPosition)
    {
        $positions = [];
        foreach($listOfPosition as $pos)
        {
            $positions[] = $this->buildPosition($pos['position'], $pos['id']);
        }
        return $positions;
    }
    
    
}
