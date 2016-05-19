<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Component;

use Symfony\Component\Security\Core\Util\SecureRandom;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\UserRepository;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use JMS\DiExtraBundle\Annotation as JMS;
use AppBundle\Events;
use AppBundle\Event\Email\EmailPasswordEvent;


/**
 * Description of UserManager
 * @JMS\Service("app.component.usermanager")
 */
class UserManager
{
    /** 
     * @var UserRepository
     */
    private $userRepo;
    
    /** 
     * @var EntityManager 
     */
    private $em;
    
    /** 
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    
    /** 
     * @var EventDispatcherInterface
     */
    private $dispatcher;
    
    /** 
     * @var SecureRandom 
     */
    private $randonPasswordGenerator;
    
    /** 
     * @var password 
     */
    private $password;
    
    /**
     * @JMS\InjectParams({
     *     "em" = @JMS\Inject("doctrine.orm.entity_manager"),
     *     "userRepo" = @JMS\Inject("app.repository.user"),
     *     "encoder" = @JMS\Inject("security.password_encoder"),
     *     "dispatcher" = @JMS\Inject("event_dispatcher")
     * })
     */
    public function __construct(EntityManager $em, UserRepository $userRepo, UserPasswordEncoderInterface $encoder, EventDispatcherInterface $dispatcher)
    {
        $this->userRepo =$userRepo;
        $this->em = $em;
        $this->encoder = $encoder;
        $this->dispatcher = $dispatcher;
        $this->randonPasswordGenerator = new SecureRandom();
    }
    
    public function resetUserPassword(User $user, $newpassword = null)
    {
        $this->password = (null === $newpassword) ? $this->generateRandomPassword() : $newpassword;
        $user->setPassword($this->encoder->encodePassword($user, $this->getPassword()));
        $this->em->persist($user);
        $this->em->flush();
    }
    
    public function setNewUser(User $user)
    {
        $this->password = $this->generateRandomPassword();
        $user->setIsActive(true)
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->encoder->encodePassword($user, $this->getPassword()));
        return $user;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function sendNewUserEmail(User $user)
    {
        $this->dispatcher->dispatch(Events::EMAIL_NEW_PASSWORD,  new EmailPasswordEvent($user->getEmail(), $this->getPassword()));
    }
    
    public function generateRandomPassword()
    {
        return  bin2hex($this->randonPasswordGenerator->nextBytes(4));
    }
    
}
