<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BackendBundle:User')->find(1);
        echo "Bienvenido ".$user->getName()." ".$user->getSurname();

        var_dump($this->json($user));die();
        return $this->render('BackendBundle:Default:index.html.twig');
    }
}
