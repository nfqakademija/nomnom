<?php

namespace Nfq\NomNomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NfqNomNomBundle:Default:index.html.twig', array('name' => $name));
    }
}
