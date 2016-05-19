<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\DataFixtures\ORM;
/**
 * Description of LoadUserData
 *
 * @author student
 */
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
{
    
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $plainPassword = 'password';
        $encoder = $this->container->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encoded);
        $user->setEmail('glaserpower@gmail.com');
        $user->setIsActive(true);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);        
        
        $user2 = new User();
        $plainPassword2 = 'passweord';
        $encoded = $encoder->encodePassword($user2, $plainPassword2);
        $user2->setPassword($encoded);
        $user2->setEmail('glaserpowssser@gmail.com');
        $user2->setIsActive(true);
        $user2->setRoles(['ROLE_ADMIN']);
        $manager->persist($user2);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}