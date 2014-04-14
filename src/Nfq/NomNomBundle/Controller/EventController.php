<?php
/**
 * Created by PhpStorm.
 * User: Kodvin
 * Date: 4/9/14
 * Time: 6:32 PM
 */

namespace Nfq\NomNomBundle\Controller;


use Nfq\NomNomBundle\Form\Type\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nfq\NomNomBundle\Utilities;
use Nfq\NomNomBundle\Entity\MyEvent;
use Nfq\NomNomBundle\Entity\MyUserEvent;
use Nfq\NomNomBundle\Entity\MyEventRecipe;
use Symfony\Component\HttpFoundation\Request;


class EventController extends Controller
{
    public function eventManagerAction()
    {
        $user = $this->getUser();
        if ($user) {
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
        if ($user) {
            $em = $this->getDoctrine()->getManager();
            /**@var $myEvent MyEvent */
            $myEvent = $em->getRepository('NfqNomNomBundle:MyEvent')->find($eventId);

            if (Utilities::hasUserPermissionToEvent($myEvent, $user, $em)) {
                switch ($myEvent->getEventPhase()) {
                    case 0:
                        return $this->processPhaseOne($eventId);
                    case 1:
                        return $this->processPhaseTwo($eventId);
                    case 2:
                        return $this->ProcessPhaseThree($eventId);
                }
            } else {
                return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => "you don't have permission to this evvent"));
            }
        }
        return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log  in first'));
    }

    public function createEventAction(Request $request)
    {
        $event = new MyEvent();
        $form = $this->createForm(new EventType(), $event);
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
            $form = $this->createForm($this->get('nfq_nom_nom.form.type.adduserstoevent'));
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

    public function addRecipeToEventAction($eventId, Request $request)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        /**@var $myEvent MyEvent */
        $myEvent = $em->getRepository('NfqNomNomBundle:MyEvent')->find($eventId);

        if ($user) {
            $form = $this->createForm('addrecipetoevent');
            $form->handleRequest($request);

            if ($form->isValid()) {
                //check if current user is participating in this event
                $someEventRecipe = $em->getRepository('NfqNomNomBundle:MyEventRecipe')
                    ->findByEventAndRecipe($myEvent, $form->getData()['recipe']);
                if (empty($someEventRecipe)) {
                    $eventRecipe = new MyEventRecipe();
                    $eventRecipe->setMyEvent($myEvent);
                    $eventRecipe->setMyRecipe($form->getData()['recipe']);
                    $eventRecipe->setTotalUpvote(0);

                    $em->persist($eventRecipe);
                    $em->flush();
                }
                return $this->redirect($this->generateUrl('Nfq_nom_nom_events', array('eventId' => $eventId)));
            } else {
                return $this->render('NfqNomNomBundle:Event:addrecipetoevent.html.twig',
                    array('forma' => $form->createView(),
                        'error' => ''));
            }
        } else {
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log in  first'));
        }
    }

    public function acceptEventAction($userEventId)
    {
        $user = $this->getUser();

        if (!$user) {
            $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log in  first'));
        }

        $em = $this->getDoctrine()->getManager();
        /** @var MyUserEvent $myUserEvent */
        $myUserEvent = $em->getRepository('NfqNomNomBundle:MyUserEvent')
            ->find($userEventId);

        if (!$myUserEvent) {
            $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'something went wrong.'));
        }

        if ($myUserEvent->getMyUser() == $user) {
            $myUserEvent->setInvitationStatus(2);
            $em->flush();
        } else {
            $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'you don\'t have permission.'));
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

        if ($user == $hostUser) {
            $hostEvent = $hostUserEvent->getMyEvent();
            $eventPhase = $hostEvent->getEventPhase();
            //making sure user will not force eventphase to be bigger than 3
            if($eventPhase < 3){
                $hostEvent->setEventPhase($hostEvent->getEventPhase() + 1);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl("Nfq_nom_nom_events", array('eventId' => $eventId)));
    }

    public function processPhaseOne($eventId)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        /**@var $myEvent MyEvent */
        $myEvent = $em->getRepository('NfqNomNomBundle:MyEvent')->find($eventId);
        $repUE = $em->getRepository('NfqNomNomBundle:MyUserEvent');
        $repER = $em->getRepository('NfqNomNomBundle:MyEventRecipe');

        //find host(there should be only one) of the event
        /** @var MyUserEvent $host */
        $hostUser = $repUE->findbyEventHost($eventId)['0'];

        //find users that accepted invitations to this event
        $acceptedUsers = $repUE->findByEventAccepted($eventId);

        //find users that are invited to this event
        $invitedUsers = $repUE->findByEventInvited($eventId);

        //find all eventRecipes for this event
        $eventRecipes = $repER->findByEvent($eventId);

        $userEvent = $repUE->findByEventAndUser($myEvent, $user)['0'];

        $progressionButtonText = '';
        if ($this->getUser() == $hostUser->getMyUser()) {
            $progressionButtonText = 'end recipe suggestion';
        }

        return $this->render('NfqNomNomBundle:Event:eventphaseone.html.twig',
            array('error' => '',
                'event' => $myEvent,
                'acceptedUE' => $acceptedUsers,
                'invitedUE' => $invitedUsers,
                'host' => $hostUser,
                'progButton' => $progressionButtonText,
                'eventRecipes' => $eventRecipes,
                'currentUserEvent' => $userEvent));
    }

    public function processPhaseTwo($eventId)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        /**@var $myEvent MyEvent */
        $myEvent = $em->getRepository('NfqNomNomBundle:MyEvent')->find($eventId);
        $repUE = $em->getRepository('NfqNomNomBundle:MyUserEvent');
        $repER = $em->getRepository('NfqNomNomBundle:MyEventRecipe');

        //find host(there should be only one) of the event
        /** @var MyUserEvent $host */
        $hostUser = $repUE->findbyEventHost($eventId)['0'];

        //find users that accepted invitations to this event
        $acceptedUsers = $repUE->findByEventAccepted($eventId);

        //find users that are invited to this event
        $invitedUsers = $repUE->findByEventInvited($eventId);

        //find all eventRecipes for this event
        $eventRecipes = $repER->findByEvent($eventId);

        $userEvent = $repUE->findByEventAndUser($myEvent, $user)['0'];

        $progressionButtonText = '';
        if ($this->getUser() == $hostUser->getMyUser()) {
            $progressionButtonText = 'finalize event';
        }

        return $this->render('NfqNomNomBundle:Event:eventphasetwo.html.twig',
            array('error' => '',
                'event' => $myEvent,
                'acceptedUE' => $acceptedUsers,
                'invitedUE' => $invitedUsers,
                'host' => $hostUser,
                'progButton' => $progressionButtonText,
                'eventRecipes' => $eventRecipes,
                'currentUserEvent' => $userEvent));
    }

    public function processPhaseThree($eventId)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        /**@var $myEvent MyEvent */
        $myEvent = $em->getRepository('NfqNomNomBundle:MyEvent')->find($eventId);
        $repUE = $em->getRepository('NfqNomNomBundle:MyUserEvent');
        $repER = $em->getRepository('NfqNomNomBundle:MyEventRecipe');

        //find host(there should be only one) of the event
        /** @var MyUserEvent $host */
        $hostUser = $repUE->findbyEventHost($eventId)['0'];

        //find users that accepted invitations to this event
        $acceptedUsers = $repUE->findByEventAccepted($eventId);

        //find users that are invited to this event
        $invitedUsers = $repUE->findByEventInvited($eventId);

        //find all eventRecipes for this event
        $eventRecipes = $repER->findByEvent($eventId);

        $userEvent = $repUE->findByEventAndUser($myEvent, $user)['0'];

        return $this->render('NfqNomNomBundle:Event:eventphasethree.html.twig',
            array('error' => '',
                'event' => $myEvent,
                'acceptedUE' => $acceptedUsers,
                'invitedUE' => $invitedUsers,
                'host' => $hostUser,
                'eventRecipes' => $eventRecipes,
                'currentUserEvent' => $userEvent));
    }
} 