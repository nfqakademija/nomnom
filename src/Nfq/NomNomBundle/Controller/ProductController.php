<?php
/**
 * Created by PhpStorm.
 * User: Andrius
 * Date: 4/14/14
 * Time: 12:42 PM
 */

namespace Nfq\NomNomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller{

   public function addUserProductAction($userEventId, $recipeProductId)
   {
       $em = $this->getDoctrine()->getManager();
       $myUserProductRepository = $em->getRepository('NfqNomNomBundle:MyUserProduct');

       return $this->redirect($this->generateUrl('Nfq_nom_nom_events',
           array('eventId' => $userEventId)));
   }
} 