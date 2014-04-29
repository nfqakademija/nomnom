<?php
/**
 * Created by PhpStorm.
 * User: Andrius
 * Date: 4/14/14
 * Time: 12:42 PM
 */

namespace Nfq\NomNomBundle\Controller;

use Nfq\NomNomBundle\Entity\MyUserEvent;
use Nfq\NomNomBundle\Entity\MyUserProduct;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{

    public function addUserProductAction($userEventId, $recipeProductId)
    {
        $em = $this->getDoctrine()->getManager();
        $myUserProductRepository = $em->getRepository('NfqNomNomBundle:MyUserProduct');
        $myRecipeProductRepository = $em->getRepository('NfqNomNomBundle:MyRecipeProduct');
        $myUserEventRepository = $em->getRepository('NfqNomNomBundle:MyUserEvent');

        $myUserProduct = $myUserProductRepository->
            findByUserEventAndRecipeProduct($userEventId, $recipeProductId);

        if (empty($myUserProduct)) {
            $recipeProduct = $myRecipeProductRepository->find($recipeProductId);
            /** @var MyUserEvent $userEvent */
            $userEvent = $myUserEventRepository->find($userEventId);
            //TODO should persist quantity and measurements but for
            //TODO now we will say that all products you are taking by yourself

            $newUserProduct = new MyUserProduct();
            $newUserProduct->setMyRecipeProduct($recipeProduct);
            $newUserProduct->setMyUserEvent($userEvent);
            $newUserProduct->setQuantity(0);
            $newUserProduct->setQuantityMeasure(0);

            $em->persist($newUserProduct);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Nfq_nom_nom_events',
            array('eventId' => $userEvent->getMyEvent()->getId())));
    }
} 