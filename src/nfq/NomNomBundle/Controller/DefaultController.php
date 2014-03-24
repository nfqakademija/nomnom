<?php

namespace nfq\NomNomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('nfqNomNomBundle:Default:index.html.twig', array('name' => $name));
    }
}
