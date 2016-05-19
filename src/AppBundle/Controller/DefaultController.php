<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage", options={"expose"=true})
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need

        return $this->render('AppBundle::layout.html.twig', ['tab' => 'home']);
    }

    /**
     * @Route("/contact", name="contact", options={"expose"=true})
     */
    public function contactAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle::layout.html.twig', ['tab' => 'contact']);
    }

    /**
     * @Route("/privacypolicy", name="privacypolicy", options={"expose"=true})
     */
    public function privacyPolicyAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle::layout.html.twig', ['tab' => 'privacy']);
    }

    /**
     * @Route("/community", name="community", options={"expose"=true})
     */
    public function commuinityAction(Request $request)
    {
        return $this->render('AppBundle::layout.html.twig', ['tab' => 'community']);
    }

    /**
     * @Route("/projects", name="projects", options={"expose"=true})
     */
    public function projectAction(Request $request)
    {
        return $this->render('AppBundle::layout.html.twig', ['tab' => 'projects']);
    }

    /**
     * @Route("/jobs", name="jobs", options={"expose"=true})
     */
    public function experienceAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository('AppBundle:Job');
        $Job=$repository->findAll();

        return $this->render('AppBundle::layout.html.twig', ['tab' => 'jobs','container'=>$Job]);
    }

    /**
     * @Route("/skills", name="skill", options={"expose"=true})
     */
    public function skillAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository('AppBundle:Skill');
        $skill=$repository->findAll();

        return $this->render('AppBundle::layout.html.twig', ['tab' => 'skill','container'=>$skill]);
    }

    /**
     * @Route("/about", name="aboutsite", options={"expose"=true})
     */
    public function aboutAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle::layout.html.twig', ['tab' => 'about']);
    }
    
    /** 
     * @Route("/test", name="test_page")
     * @param Request $request
     * @return type
     */
    public function testJasmineAction(Request $request) 
    {
        return $this->render('AppBundle::test_layout.html.twig');
    }
    
}
