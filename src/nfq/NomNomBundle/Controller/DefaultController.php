<?php

namespace Nfq\NomNomBundle\Controller;

use Nfq\NomNomBundle\Entity\MyEvent;
use Nfq\NomNomBundle\Entity\MyUserEvent;
use Nfq\NomNomBundle\Entity\User;
use Nfq\NomNomBundle\Form\Type\EventType;
use Nfq\NomNomBundle\NfqNomNomBundle;
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
            return $this->render('NfqNomNomBundle:Default:event.html.twig', array('error' => ''));
        } else {
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log  in first'));
        }
    }

    public function eventManagerAction()
    {
        $user = $this->getUser();
        // TODO: we should check is the user is registered but maybe this is enough
        if ($user != '') {
            $em = $this->getDoctrine()->getManager();
            //getting all userevent objects where user_id is current users id
            $myUserEvents = $em->createQuery('SELECT m FROM NfqNomNomBundle:MyUserEvent m WHERE m.myUser = :myuser')
                ->setParameter('myuser', $user)
                ->getResult();

            //getting array of eventName and eventIds pairs
            $names = array();
            foreach ($myUserEvents as $mue) {
                $temp = array();
                $temp[] = $mue->getMyEvent()->getEventName();
                $temp[] = $mue->getMyEvent()->getId();
                $names[] = $temp;
            }

            return $this->render('NfqNomNomBundle:Default:eventmanager.html.twig',
                array('names' => $names,
                    'error' => ''));
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
                //setting default event fields
                $event->setEventPhase(0);
                $event->setDateCreated(new \DateTime());
                $em = $this->getDoctrine()->getManager();

                //getting current user
                $currentUser = $em->getRepository('NfqNomNomBundle:User')
                    ->findOneBy(
                        array('username' => get_current_user())
                    );

                //getting registredUser role_id
                $registeredUserRole = $em->getRepository('NfqNomNomBundle:MyRole')
                    ->findOneBy(
                        array('roleName' => 'registeredUser')
                    );

                //creating new user event with current user and registeredUser role
                $eventUser = new MyUserEvent();
                $eventUser->setMyUser($currentUser);
                $eventUser->setInvitationStatus(0);
                $eventUser->setMyEvent($event);
                $eventUser->setMyRole($registeredUserRole);

                $em->persist($eventUser);
                $em->persist($event);
                $em->flush();

                return $this->redirect($this->generateUrl('Nfq_nom_nom_event_manager'));
            }
        }

        return $this->render('NfqNomNomBundle:Default:createevent.html.twig',
            array('forma' => $form->createView(),
                'error' => ''));
    }
}