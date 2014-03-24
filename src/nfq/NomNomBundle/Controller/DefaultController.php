<?php

namespace Nfq\NomNomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NfqNomNomBundle:Default:index.html.twig');
    }
}
