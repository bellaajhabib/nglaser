<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\PositionInterface;

class PositionDuplicateValidator extends ConstraintValidator
{
    /** 
     * @var EntityRepository 
     */
    private $repository;
    
    public function __construct(EntityRepository $repository) 
    {
        $this->repository = $repository;
    }
    
    /** 
     * @param PositionInterface $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint) 
    {
        $objects = $this->repository->findAll();
        foreach($objects as $object){
            /** @var PositionInterface **/
            if($value->getId() !== $object->getId() && $value->getPosition() == $object->getPosition()){
                $this->context->buildViolation($constraint->message)
                    ->atPath('position')
                    ->addViolation();
            }
        }
    }

}
