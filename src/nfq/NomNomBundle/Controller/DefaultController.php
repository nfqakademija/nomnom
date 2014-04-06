<?php

namespace Nfq\NomNomBundle\Controller;

use Nfq\NomNomBundle\Entity\MyEvent;
use Nfq\NomNomBundle\Entity\MyUserEvent;
use Nfq\NomNomBundle\Entity\User;
use Nfq\NomNomBundle\Form\Type\EventType;
use Nfq\NomNomBundle\NfqNomNomBundle;
use Nfq\NomNomBundle\Utilities;
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
            $em = $this->getDoctrine()->getManager();
            /**@var $myEvent MyEvent */
            $myEvent = $em->getRepository('NfqNomNomBundle:MyEvent')->find($eventId);
            if (Utilities::hasUserPermissionToEvent($myEvent, $user, $em)) {
                $myEventArray = array();
                 $userNames = array();

                $myEventArray['dateCreated'] = $myEvent->getDateCreated()->format('Y-m-d H:i:s');
                $myEventArray['eventName'] = $myEvent->getEventName();
                $myEventArray['eventDate'] = $myEvent->getEventDate()->format('Y-m-d H:i:s');
                $myEventArray['eventPhase'] = $myEvent->getEventPhase();

                return $this->render('NfqNomNomBundle:Default:event.html.twig',
                    array('error' => '',
                        'event' => $myEventArray,
                        'eventId' => $eventId));
            } else {
                return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => "you don't have permission to this evvent"));
            }
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

            //getting array of eventName and eventId pairs
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

    public function addUsersToEventAction($eventId, Request $request)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        /**@var $myEvent MyEvent */
        $myEvent = $em->getRepository('NfqNomNomBundle:MyEvent')->find($eventId);

        if (Utilities::hasUserPermissionToEvent($myEvent, $user, $em)) {
            $form = $this->createForm('adduserstoevent');
            $form->handleRequest($request);

            if ($form->isValid()) {

                $userEvent = new MyUserEvent();
                /** @var @var Nfq\NomNomBundle\Entity\MyRole $myRole */
                $myRole = $em->getRepository('NfqNomNomBundle:MyRole')
                    ->findOneBy(array('roleName' => 'participatingUser'));

                $userEvent->setMyEvent($myEvent);
                $userEvent->setMyRole($myRole);
                $userEvent->setInvitationStatus(1);
                $userEvent->setMyUser($form->getData()['user']);

                $em->persist($userEvent);
                $em->flush();

                return $this->redirect($this->generateUrl('Nfq_nom_nom_events',array('eventId' => $eventId)));
            } else {
                return $this->render('NfqNomNomBundle:Default:adduserstoevent.html.twig',
                    array('forma' => $form->createView(),
                        'error' => ''));
            }
        } else {
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log in  first'));
        }
    }
}