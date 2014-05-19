<?php
/**
 * Created by PhpStorm.
 * User: MDSKLLZ
 * Date: 14.5.13
 * Time: 04.12
 */

namespace Nfq\NomNomBundle\Controller;

use Nfq\NomNomBundle\Entity\MyNotification;
use Nfq\NomNomBundle\Entity\MyNotificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class TestController extends Controller
{
    public function abcAction (){

        return $this->render('NfqNomNomBundle:Default:test.html.twig', array('error' => ''));

    }

    public function testoAction () {

        $repository = $this->getDoctrine()->getRepository('NfqNomNomBundle:MyRecipe');
        $em = $this->getDoctrine()->getManager();

        $abc = $repository->findAll();

        return $this->render('NfqNomNomBundle:Default:test.html.twig', array('error' => '', 'recipes' => $abc));


    }

    public function testAction (Request $request) {





        $form = $this->createForm('browserecipes');

        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository('NfqNomNomBundle:MyRecipe');
        $ret = NULL;
        var_dump($form->getData()['servfrom']);
        var_dump($form->getData()['servto']);
            if ($form->isSubmitted()) {
                $ret = $repository->filterByCategory(
                    $form->getData()['side'],
                    $form->getData()['main'],
                    $form->getData()['deserts'],
                    $form->getData()['soups'],
                    $form->getData()['servfrom'],
                    $form->getData()['servto'],
                    $form->getData()['prepfrom'],
                    $form->getData()['prepto']
                );

                return $this->render ('NfqNomNomBundle:Default:test.html.twig', array('error' => '', 'forma' => $form->createView(), 'recipes' => $ret));

            }

        return $this->render('NfqNomNomBundle:Default:test.html.twig', array('error' => '', 'forma' => $form->createView(),'recipes'=>$ret));


    }




}