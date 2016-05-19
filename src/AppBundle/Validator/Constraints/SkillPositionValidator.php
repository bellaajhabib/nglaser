<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use AppBundle\Entity\Skill;
use AppBundle\Entity\SkillRepository;


/**
 * Description of SkillPositionValidator
 * @author student
 */
class SkillPositionValidator extends ConstraintValidator
{
    /** 
     * @var SkillRepository
     */
    private $skillRepository;
    
    
    /**
     * @JMS\InjectParams({
     *     "skillRepository" = @JMS\Inject("doctrine.entity_manager")
     * })
     */
    public function __construct(SkillRepository $skillRepository) 
    {
        $this->skillRepository = $skillRepository;
    }
    
    /** 
     * 
     * @param Skill $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint) 
    {
        $skills = $this->skillRepository->findAll();

        foreach($skills as $skill)  {
            if($value->getId() != $skill->getId() && $value->getType() == $skill->getType() && $value->getPosition() == $skill->getPosition()) {
                $this->context->buildViolation($constraint->message)
                    ->atPath('position')
                    ->addViolation();
            }
        }
    }
}
