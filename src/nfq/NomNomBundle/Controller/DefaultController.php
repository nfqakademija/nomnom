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

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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

        return $this->render('NfqNomNomBundle:Default:createevent.html.twig',
            array('forma' => $form->createView(),
                'error' => ''));
    }

    public
    function addUsersToEventAction($eventId, Request $request)
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
                    ->findUserEvent($myEvent, $this->getUser());
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
                return $this->render('NfqNomNomBundle:Default:adduserstoevent.html.twig',
                    array('forma' => $form->createView(),
                        'error' => ''));
            }
        } else {
            return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => 'log in  first'));
        }
    }

    public
    function profileAction()
    {
        return $this->render('NfqNomNomBundle:Default:profile.html.twig');
    }

    public
    function profileEditAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $userManager = $this->container->get('fos_user.user_manager');

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('Nfq_nom_nom_profile');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }
        return $this->container->get('templating')->renderResponse(
        //'FOSUserBundle:Profile:edit.html.' . $this->container->getParameter('fos_user.template.engine'),
            'NfqNomNomBundle:Default:profileEdit.html.twig',
            array('form' => $form->createView())
        );
    }

    public
    function changePasswordAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.change_password.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $userManager = $this->container->get('fos_user.user_manager');

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('Nfq_nom_nom_profile');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }

        return $this->container->get('templating')->renderResponse(
        //'FOSUserBundle:ChangePassword:changePassword.html.'.$this->container->getParameter('fos_user.template.engine'),
            'NfqNomNomBundle:Default:changepassword.html.twig',
            array('form' => $form->createView())
        );
    }


}