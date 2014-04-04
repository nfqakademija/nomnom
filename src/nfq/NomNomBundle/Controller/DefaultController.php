<?php

namespace Nfq\NomNomBundle\Controller;

use Nfq\NomNomBundle\Entity\MyEvent;
use Nfq\NomNomBundle\Form\Type\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => ''));
    }

    public function getAvatarAction($avatarId)
    {
        $userProfile = $this->getDoctrine()
            ->getRepository("NfqNomNomBundle:myUserProfile")
            ->find($avatarId);

        $img = base64_decode(stream_get_contents($userProfile->getAvatar()));

        $response = new Response(
            $img,
            Response::HTTP_OK,
            array('content-type' => 'image/png',
                'Content-transfer-encoding' => 'binary')
        );
        return $response;
    }

    public function eventAction($eventId)
    {
        $user = $this->getUser();
        if ($user != '') {
            return $this->render('NfqNomNomBundle:Default:event.html.twig');
        } else {
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log  in first'));
        }
    }

    public function eventManagerAction()
    {
        $user = $this->getUser();
        if ($user != '') {
            return $this->render('NfqNomNomBundle:Default:eventmanager.html.twig', array('error' => ''));
        } else {
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log in  first'));
        }
    }

    public function createEventAction(Request $request)
    {
        $event = new MyEvent();
        $form = $this->createForm('event', $event);
        $form->get('eventDate')->setData(new \DateTime());

        if ($request->isMethod("POST")) {
            $form->submit($request);
            if ($form->isValid()) {

                $event->setEventPhase(0);
                $event->setDateCreated(new \DateTime());

                $em = $this->getDoctrine()->getManager();
                $em->persist($event);
                $em->flush();
                return $this->redirect($this->generateUrl('Nfq_nom_nom_event_manager'));
            }
        }
        return $this->render('NfqNomNomBundle:Default:createevent.html.twig', array('forma' => $form->createView(), 'error' => ''));
    }
}