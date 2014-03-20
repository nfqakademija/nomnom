<?php

namespace Vaiva\VaivaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vaiva\VaivaBundle\Entity\Product;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $product = new Product();
        $product ->setName('Book');
        $product->setPrice(1.5);

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em -> flush();

        return $this->render('VaivaVaivaBundle:Default:index.html.twig', array('name' => $name));
    }
}
