<?php
/**
 * Created by PhpStorm.
 * User: Kodvin
 * Date: 4/9/14
 * Time: 6:32 PM
 */

namespace Nfq\NomNomBundle\Controller;


use Nfq\NomNomBundle\Entity\MyProduct;
use Nfq\NomNomBundle\Entity\MyRecipe;
use Nfq\NomNomBundle\Entity\MyRecipeProduct;
use Nfq\NomNomBundle\Form\Type\EventType;
use Nfq\NomNomBundle\Form\Type\UserProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nfq\NomNomBundle\Utilities;
use Nfq\NomNomBundle\Entity\MyEvent;
use Nfq\NomNomBundle\Entity\MyUserEvent;
use Nfq\NomNomBundle\Entity\MyEventRecipe;
use Nfq\NomNomBundle\Entity\MyUserProduct;
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

    public function eventAction($eventId, Request $request)
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
                        return $this->processPhaseTwo($eventId, $request);
                    case 2:
                        return $this->processPhaseThree($eventId);
                    case 3:
                        //for now we render ended event as finalized event
                        //but in event manager link they are separated
                        return $this->processPhaseThree($eventId);
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
        $event->setEventDate(new \DateTime());
        $event->setEventPlaningDueDate(new \DateTime());
        $form = $this->createForm(new EventType(), $event);

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
                $eventUser->setReadyToPhaseTwo(0);
                $eventUser->setReadyToPhaseThree(0);

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
                    $userEvent->setReadyToPhaseTwo(0);
                    $userEvent->setReadyToPhaseThree(0);

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
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log in  first'));
        }

        $em = $this->getDoctrine()->getManager();
        /** @var MyUserEvent $myUserEvent */
        $myUserEvent = $em->getRepository('NfqNomNomBundle:MyUserEvent')
            ->find($userEventId);

        $pastDueDate = 3;
        //check if the event is past due date
        if ($myUserEvent->getmyEvent()->getEventPhase() == $pastDueDate) {
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'event has ended.'));
        }

        if (!$myUserEvent) {
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'something went wrong.'));
        }

        if ($myUserEvent->getMyUser() == $user) {
            $myUserEvent->setInvitationStatus(2);
            $em->flush();
        } else {
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'you don\'t have permission.'));
        }

        return $this->redirect($this->generateUrl('Nfq_nom_nom_event_manager'));
    }

    public function progressEventAction($eventId, Request $request)
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

            if ($eventPhase == 0) {
                $hostEvent->setEventPhase($eventPhase + 1);
                $em->flush();
            } else if ($eventPhase == 1) {
                //perform event finalization validation
                if ($this->eventFinalizationCheck($eventId)) {
                    $hostEvent->setEventPhase($eventPhase + 1);
                    $em->flush();
                } else {
                    //TODO ask if this is solution a bad practise
                    $error = 'you must assign all products before finalizing the event';
                    return $this->processPhaseTwo($eventId, $request, $error);
                }
            }
        }

        return $this->redirect($this->generateUrl("Nfq_nom_nom_events", array('eventId' => $eventId)));
    }

    public function regressEventAction($eventId)
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
            //if the event is finalized you cannot go back.
            //you can only go back to select more recepies and revote them
            if ($eventPhase == 1) {
                $hostEvent->setEventPhase($eventPhase - 1);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl("Nfq_nom_nom_events", array('eventId' => $eventId)));
    }

    public function readyToProgressAction($eventId)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $userEventRepository = $em->getRepository('NfqNomNomBundle:MyUserEvent');

        //find userEvent where user accepted invitation of event
        /** @var MyUserEvent $acceptedUserEvent */
        $acceptedUserEvent = $userEventRepository->findbyEventAndUser($eventId, $user);

        if (!empty($acceptedUserEvent)) {
            $acceptedEvent = $acceptedUserEvent['0']->getMyEvent();
            $eventPhase = $acceptedEvent->getEventPhase();

            if ($eventPhase == 0) {
                /**@var MyUserEvent $acceptedEvent */
                $acceptedUserEvent['0']->setReadyToPhaseTwo(1);
                $em->flush();
            } else if ($eventPhase == 1) {
                /**@var MyUserEvent $acceptedEvent */
                $acceptedUserEvent['0']->setReadyToPhaseThree(1);
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

        $isHost = $this->getUser() == $hostUser->getMyUser();

        $readyPeople = $repUE->getReadyPercentagePhaseTwo($eventId);

        return $this->render('NfqNomNomBundle:Event:eventphaseone.html.twig',
            array('error' => '',
                'event' => $myEvent,
                'acceptedUE' => $acceptedUsers,
                'invitedUE' => $invitedUsers,
                'host' => $hostUser,
                'isHost' => $isHost,
                'eventRecipes' => $eventRecipes,
                'currentUserEvent' => $userEvent,
                'readyPeople' => $readyPeople));
    }

    public function processPhaseTwo($eventId, Request $request, $error = '')
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        /**@var $myEvent MyEvent */
        $myEvent = $em->getRepository('NfqNomNomBundle:MyEvent')->find($eventId);
        $repUE = $em->getRepository('NfqNomNomBundle:MyUserEvent');
        $repUP = $em->getRepository('NfqNomNomBundle:MyUserProduct');
        $repER = $em->getRepository('NfqNomNomBundle:MyEventRecipe');

        //find host(there should be only one) of the event
        /** @var MyUserEvent $host */
        $hostUser = $repUE->findbyEventHost($eventId)['0'];

        //find users that accepted invitations to this event
        $acceptedUsers = $repUE->findByEventAccepted($eventId);

        //find users that are invited to this event
        $invitedUsers = $repUE->findByEventInvited($eventId);

        $userEvent = $repUE->findByEventAndUser($myEvent, $user)['0'];

        //this array is holding all the information about recipes in this event that we're going to show
        //**********************************************************************************************
        $information = array();
        //find all eventRecipes for this event
        $eventRecipes = $repER->findByEventWithRecipe($userEvent->getMyEvent()->getId());

        foreach ($eventRecipes as $eventRecipe) {
            /** @var MyRecipe $recipe */
            $recipe = $eventRecipe->getMyRecipe();

            $tovalVotes = $eventRecipe->getTotalUpvote();
            $recipeProducts = $recipe->getMyRecipeProducts();

            $inner = array();
            $subInner = array();
            foreach ($recipeProducts as $recipeProduct) {
                /** @var MyRecipeProduct $r */
                $r = $recipeProduct;
                $myUserProducts = $repUP->findByEventAndRecipeProduct($userEvent->getMyEvent(), $recipeProduct);

                $bringers = array();
                //add all the bringers names to names array
                if (!empty($myUserProducts)) {
                    foreach ($myUserProducts as $mup) {
                        $name = $mup->getMyUserEvent()->getMyUser()->getUsername();
                        $amount = $mup->getQuantity();
                        $bringers[] = array('name' => $name,
                            'quantity' => $amount);

                    }
                }

                $bringersUP = $repUP->findByUserEventAndRecipeProduct($userEvent, $recipeProduct);

                // if no quantity and no quantity measure - don't show input field
                $hidden_field = false;
                if ($recipeProduct->getQuantity() == 0 &&
                    $recipeProduct->getMyQuantityMeasure()->getMyQuantityMeasureName() == ''
                ) {
                    $hidden_field = true;
                }

                $userProductType = new UserProductType($userEvent->getId(), $recipeProduct->getId(), $hidden_field);
                if (!empty($bringersUP)) {
                    $bringersUP = $bringersUP['0'];
                    $form = $this->createForm(
                        $userProductType
                    );
                } else {
                    $bringersUP = new MyUserProduct();
                    $bringersUP->setMyUserEvent($userEvent);
                    $bringersUP->setMyRecipeProduct($recipeProduct);
                    $bringersUP->setQuantityMeasure($r->getMyQuantityMeasure()->getMyQuantityMeasureName());
                    $form = $this->createForm(
                        $userProductType
                    );
                }
                if ($request->isMethod("POST")) {
                    if ($request->request->getIterator()->key() == $form->getName()) {


                        $form->setData($bringersUP);
                        $form->submit($request);
                        if ($form->isValid()) {

                            $em->persist($bringersUP);
                            $em->flush();
                            $this->redirect($this->generateUrl('Nfq_nom_nom_events', array('eventId' => $eventId)));
                        }
                    }
                }

                /** @var MyProduct $myProduct */
                $myProduct = $recipeProduct->getMyProduct();
                $subInner[] = array(
                    'productName' => $myProduct->getProductName(),
                    'quantity' => $r->getQuantity(),
                    'quantityMeasure' => $r->getMyQuantityMeasure()->getMyQuantityMeasureName(),
                    'userEventId' => $userEvent->getId(),
                    'recipeProductId' => $recipeProduct->getId(),
                    'bringers' => $bringers,
                    'forma' => $form->createView(),
                    'quantityDisplay' => $r->getQuantityDisplay($eventRecipe)
                );
            }
            $inner['totalUpvote'] = $tovalVotes;
            $inner['products'] = $subInner;
            $inner['id'] = $recipe->getId();
            $inner['servings'] = $recipe->getNumberOfServings();
            $information[$recipe->getRecipeName()] = $inner;
        }
        //**************************************************************
        $isHost = $this->getUser() == $hostUser->getMyUser();

        $readyPeople = $repUE->getReadyPercentagePhaseThree($eventId);

        return $this->render('NfqNomNomBundle:Event:eventphasetwo.html.twig',
            array('error' => $error,
                'event' => $myEvent,
                'acceptedUE' => $acceptedUsers,
                'invitedUE' => $invitedUsers,
                'host' => $hostUser,
                'isHost' => $isHost,
                'information' => $information,
                'readyPeople' => $readyPeople,
                'currentUserEvent' => $userEvent));
    }

    public function processPhaseThree($eventId, $error = "")
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        /**@var $myEvent MyEvent */
        $myEvent = $em->getRepository('NfqNomNomBundle:MyEvent')->find($eventId);
        $repUE = $em->getRepository('NfqNomNomBundle:MyUserEvent');
        $repUP = $em->getRepository('NfqNomNomBundle:MyUserProduct');
        $repER = $em->getRepository('NfqNomNomBundle:MyEventRecipe');

        //find host(there should be only one) of the event
        /** @var MyUserEvent $host */
        $hostUser = $repUE->findbyEventHost($eventId)['0'];

        //find users that accepted invitations to this event
        $acceptedUsers = $repUE->findByEventAccepted($eventId);

        $userEvent = $repUE->findByEventAndUser($myEvent, $user)['0'];

        $personalUserProducts = $repUP->findByUserEvent($userEvent);

        //find users that are invited to this event
        $invitedUsers = $repUE->findByEventInvited($eventId);

        $information = array();
        //find all eventRecipes for this event
        $eventRecipes = $repER->findByEvent($userEvent->getMyEvent()->getId());

        foreach ($eventRecipes as $eventRecipe) {
            /** @var MyRecipe $recipe */
            $recipe = $eventRecipe->getMyRecipe();
            $tovalVotes = $eventRecipe->getTotalUpvote();
            $recipeProducts = $recipe->getMyRecipeProducts();
            $inner = array();
            $subInner = array();
            foreach ($recipeProducts as $recipeProduct) {
                /** @var MyRecipeProduct $r */
                $r = $recipeProduct;
                $myUserProducts = $repUP->findByEventAndRecipeProduct($userEvent->getMyEvent(), $recipeProduct);
                $bringers = array();
                //add all the bringers names to names array
                if (!empty($myUserProducts)) {
                    foreach ($myUserProducts as $mup) {
                        $name = $mup->getMyUserEvent()->getMyUser()->getUsername();
                        $amount = $mup->getQuantity();
                        $bringers[] = array('name' => $name,
                            'quantity' => $amount);
                    }
                }

                /** @var MyProduct $myProduct */
                $myProduct = $recipeProduct->getMyProduct();
                $subInner[] = array('productName' => $myProduct->getProductName(),
                    'quantity' => $r->getQuantity(),
                    'quantityMeasure' => $r->getMyQuantityMeasure()->getMyQuantityMeasureName(),
                    'userEventId' => $userEvent->getId(),
                    'recipeProductId' => $recipeProduct->getId(),
                    'bringers' => $bringers);
            }
            $inner['totalUpvote'] = $tovalVotes;
            $inner['products'] = $subInner;
            $inner['id'] = $recipe->getId();
            $information[$recipe->getRecipeName()] = $inner;
        }

        return $this->render('NfqNomNomBundle:Event:eventphasethree.html.twig',
            array('error' => $error,
                'event' => $myEvent,
                'acceptedUE' => $acceptedUsers,
                'invitedUE' => $invitedUsers,
                'host' => $hostUser,
                'personalUserProducts' => $personalUserProducts,
                'information' => $information,
            ));
    }

    public function eventFinalizationCheck($eventId)
    {
        $whole = array();
        $em = $this->getDoctrine()->getManager();
        $myRep = $em->getRepository('NfqNomNomBundle:MyUserProduct');
        $repER = $em->getRepository('NfqNomNomBundle:MyEventRecipe');
        $repUE = $em->getRepository('NfqNomNomBundle:MyUserEvent');
        $myEvent = $em->getRepository('NfqNomNomBundle:MyEvent')->find($eventId);
        $userEvent = $repUE->findByEventAndUser($myEvent, $this->getUser())['0'];

        //find all eventRecipes for this event
        $eventRecipes = $repER->findByEvent($eventId);

        foreach ($eventRecipes as $eventRecipe) {
            /** @var MyRecipe $recipe */
            $recipe = $eventRecipe->getMyRecipe();
            $recipeProducts = $recipe->getMyRecipeProducts();
            $inner = array();
            foreach ($recipeProducts as $recipeProduct) {
                $myUserProduct = $myRep->findByEventAndRecipeProduct($userEvent->getMyEvent(), $recipeProduct);
                $name = '';
                if (!empty($myUserProduct)) {
                    $name = $myUserProduct['0']->getMyUserEvent()->getMyUser()->getUsername();
                }
                /** @var MyProduct $myProduct */
                $myProduct = $recipeProduct->getMyProduct();
                $inner[$myProduct->getProductName()] = $name;
            }
            $whole[$recipe->getRecipeName()] = $inner;
        }
        //check if there is an empty names in the array
        $returnValue = true;
        foreach ($whole as $one) {
            foreach ($one as $value) {
                if ($value == '') {
                    $returnValue = false;
                }
            }
        }
        return $returnValue;
    }
} 