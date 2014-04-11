<?php
/**
 * Created by PhpStorm.
 * User: Kodvin
 * Date: 4/9/14
 * Time: 6:32 PM
 */

namespace Nfq\NomNomBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nfq\NomNomBundle\Utilities;
use Nfq\NomNomBundle\Entity\MyEvent;
use Nfq\NomNomBundle\Entity\MyUserEvent;
use Symfony\Component\HttpFoundation\Request;


class EventController extends Controller
{
    public function eventManagerAction()
    {
        $user = $this->getUser();
        // TODO: we should check is the user is registered but maybe this is enough
        if ($user != '') {
            $rep = $this->getDoctrine()->getRepository('NfqNomNomBundle:MyUserEvent');
            //find all userevent objects where current user is host
            $hostUserEvents = $rep->findByUserHost($user);
            //find all userevnt objects where current user is invited
            $invitedUserEvents = $rep->findByUserInvited($user);
            //find all userevent objects where current user accepted invitations
            $acceptedUserEvents = $rep->findByUserAccepted($user);

            return $this->render('NfqNomNomBundle:Event:eventmanager.html.twig',
                array('error' => '',
                    'hostUE' => $hostUserEvents,
                    'invitedUE' => $invitedUserEvents,
                    'acceptedUE' => $acceptedUserEvents
                ));
        } else {
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log in  first'));
        }
    }

    public function eventAction($eventId)
    {
        $user = $this->getUser();
        if ($user != '') {
            $em = $this->getDoctrine()->getManager();
            /**@var $myEvent MyEvent */
            $myEvent = $em->getRepository('NfqNomNomBundle:MyEvent')->find($eventId);

            if (Utilities::hasUserPermissionToEvent($myEvent, $user, $em)) {
                $rep = $em->getRepository('NfqNomNomBundle:MyUserEvent');

                //find host(there should be only one) of the event
                /** @var MyUserEvent $host */
                $hostUser = $rep->findbyEventHost($eventId)['0'];

                //find users that accepted invitations to this event
                $acceptedUsers = $rep->findByEventAccepted($eventId);

                //find users that are invited to this event
                $invitedUsers = $rep->findByEventInvited($eventId);

                if ($this->getUser() == $hostUser->getMyUser()) {
                    switch ($myEvent->getEventPhase()) {
                        case 0:
                            $progressionButtonText = 'Finish recipe addition';
                            break;
                        case 1:
                            $progressionButtonText = 'Finish Event';
                            break;
                        case 2:
                            $progressionButtonText = '';
                            break;
                    }
                } else {
                    $progressionButtonText = '';
                }

                return $this->render('NfqNomNomBundle:Event:event.html.twig',
                    array('error' => '',
                        'event' => $myEvent,
                        'acceptedUE' => $acceptedUsers,
                        'invitedUE' => $invitedUsers,
                        'host' => $hostUser,
                        'progButton' => $progressionButtonText));
            } else {
                return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => "you don't have permission to this evvent"));
            }
        } else {
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log  in first'));
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

                //getting registredUser role_id
                $registeredUserRole = $em->getRepository('NfqNomNomBundle:MyRole')
                    ->findOneBy(
                        array('roleName' => 'registeredUser')
                    );

                //creating new user event with current user and registeredUser role
                $eventUser = new MyUserEvent();
                $eventUser->setMyUser($this->getUser());
                $eventUser->setInvitationStatus(0);
                $eventUser->setMyEvent($event);
                $eventUser->setMyRole($registeredUserRole);

                $em->persist($eventUser);
                $em->persist($event);
                $em->flush();

                return $this->redirect($this->generateUrl('Nfq_nom_nom_event_manager'));
            }
        }

        return $this->render('NfqNomNomBundle:Event:createevent.html.twig',
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

                /** @var @var Nfq\NomNomBundle\Entity\MyRole $myRole */
                $myRole = $em->getRepository('NfqNomNomBundle:MyRole')
                    ->findOneBy(array('roleName' => 'participatingUser'));

                $someUserEvents = $em->getRepository('NfqNomNomBundle:MyUserEvent')
                    ->findByEventAndUser($myEvent, $form->getData()['user']);
                if (empty($someUserEvents)) {
                    $userEvent = new MyUserEvent();
                    $userEvent->setMyEvent($myEvent);
                    $userEvent->setMyRole($myRole);
                    $userEvent->setInvitationStatus(1);
                    $userEvent->setMyUser($form->getData()['user']);

                    $em->persist($userEvent);
                    $em->flush();
                }
                return $this->redirect($this->generateUrl('Nfq_nom_nom_events', array('eventId' => $eventId)));
            } else {
                return $this->render('NfqNomNomBundle:Event:adduserstoevent.html.twig',
                    array('forma' => $form->createView(),
                        'error' => ''));
            }
        } else {
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log in  first'));
        }
    }

    public function acceptEventAction($userEventId)
    {
        //TODO check permisions so that other users could not accept this invitation
        $em = $this->getDoctrine()->getManager();
        /** @var MyUserEvent $myUserEvent */
        $myUserEvent = $em->getRepository('NfqNomNomBundle:MyUserEvent')
            ->find($userEventId);

        if (!$myUserEvent) {
            //TODO userevent not found handling
        } else {
            $myUserEvent->setInvitationStatus(2);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Nfq_nom_nom_event_manager'));
    }

    public function progressEventAction($eventId)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('NfqNomNomBundle:MyUserEvent');

        //find userEvent where user is host of event
        /** @var MyUserEvent $hostUserEvent */
        $hostUserEvent = $rep->findbyEventHost($eventId)['0'];
        $hostUser = $hostUserEvent->getMyUser();

        if($user == $hostUser)
        {
            $hostEvent = $hostUserEvent->getMyEvent();
            $hostEvent->setEventPhase($hostEvent->getEventPhase() + 1);
            $em->flush();
        }

        return $this->redirect($this->generateUrl("Nfq_nom_nom_events", array('eventId' => $eventId)));
    }
} 