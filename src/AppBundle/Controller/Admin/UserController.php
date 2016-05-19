<?php
namespace AppBundle\Controller\Admin;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Event\Email\EmailPasswordEvent;
use AppBundle\Events;
/**
 * Description of UserController
 *
 * @author student
 */
class UserController extends CRUDController
{
    public function resetPasswordAction(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        if(null === $user) {
            throw new NotFoundHttpException("User Not Found");
        }
        $usermanager =$this->container->get('app.component.usermanager');
        $usermanager->resetUserPassword($user);
        $event = new  EmailPasswordEvent($user->getEmail(), $usermanager->getPassword());
        $this->container->get('event_dispatcher')->dispatch(Events::EMAIL_RESET_PASSWORD, $event);
        $this->getRequest()->getSession()->getFlashBag()->set('success', 'Password Successfully Reset');
        return $this->redirect($this->generateUrl('user_list'));
    }
}
