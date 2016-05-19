<?php
namespace AppBundle\Component;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use JMS\DiExtraBundle\Annotation as JMS;
use Symfony\Component\HttpKernel\KernelEvents;


/**
 * Description of EmailManager
 * @JMS\Service("app.component.emailmanager")
 * @author student
 */
class EmailManager 
{
    /** 
     * Array of emails to send
     * @var array 
     */
    private $messages = [];
    
    /** 
     * @var \Swift_Mailer 
     */
    private $mailer;
    
    /**
     * @JMS\InjectParams({
     *     "mailer" = @JMS\Inject("mailer") 
     * })
     */
    public function __construct( \Swift_Mailer $mailer) 
    {
        $this->mailer = $mailer;
    }
    
    /** 
     * Gets a list of messages
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
    
    /** 
     * Adds Email to the list
     * @param type $subject
     * @param type $body
     * @param type $toEmail
     */
    public function addEmailToSendList(\Swift_Message $message)
    {
        $this->messages[] = $message;
    }
    
    /**
     * Sends Emails after the request
     * @JMS\Observe(KernelEvents::TERMINATE)
     */
    public function sendEmails()
    {
        foreach($this->messages as $message)
        {
            $this->mailer->send($message);
        }
    }
    
}
