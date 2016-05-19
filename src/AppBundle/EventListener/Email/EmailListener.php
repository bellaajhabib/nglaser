<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\EventListener\Email;

use AppBundle\Component\EmailManager;
use Twig_Environment;
use JMS\DiExtraBundle\Annotation as JMS;
use AppBundle\Events;
use AppBundle\Event\Email\EmailPasswordEvent;

/**
 * Description of AbstractEmailListener
 *
 * @JMS\Service()
 */
class EmailListener 
{
    
    const FROM_EMAIL = 'admin@noah.glaser.net';
    
    const FROM_EMAIL_NAME = 'noahglaser.net';
        
    /** 
     * @var EmailManager
     */
    protected $emailManager;
    
    /**
     * @JMS\InjectParams({
     *     "twig" = @JMS\Inject("twig"),
     *     "emailManager" = @JMS\Inject("app.component.emailmanager")
     * })
     */
    public function __construct(Twig_Environment $twig, EmailManager $emailManager) 
    {
        $this->twig = $twig;
        $this->emailManager = $emailManager;
    }
    
    /**
     * Sends New User the password to login
     * @JMS\Observe(Events::EMAIL_NEW_PASSWORD, priority = 255)
     * @param string $email
     * @param string $password
     */
    public function sendNewUserPasswordEmail(EmailPasswordEvent $event)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('New User Password')
            ->setFrom(self::FROM_EMAIL, self::FROM_EMAIL_NAME)
            ->setTo($event->getEmail())
            ->setBody(
                $this->twig->render(
                    'AppBundle:Email:newuser.html.twig',
                    ['email' => $event->getEmail(), 'password' => $event->getPassword()]
                ),
                'text/html'
            );
        
        $this->emailManager->addEmailToSendList($message);
    }
    
    /** 
     * @JMS\Observe(Events::EMAIL_RESET_PASSWORD, priority = 255)
     * @param string $email
     * @param string $password
     */
    public function sendResetPasswordEmail(EmailPasswordEvent $event)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Reset Password')
            ->setFrom(self::FROM_EMAIL, self::FROM_EMAIL_NAME)
            ->setTo($event->getEmail())
            ->setBody(
                $this->twig->render(
                    'AppBundle:Email:resetpassword.html.twig',
                    ['password' => $event->getPassword()]
                ),
                'text/html'
            );
        
        $this->emailManager->addEmailToSendList($message);

    }
}
