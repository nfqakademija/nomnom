<?php

namespace Nfq\NomNomBundle\Controller;

use Nfq\NomNomBundle\Entity\MyNotification;
use Nfq\NomNomBundle\Entity\MyNotificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NfqNomNomBundle:Default:index.html.twig', array('error' => ''));
    }

    public function notificationsAction()
    {
        $user = $this->getUser();
        if ($user) {

            $em = $this->getDoctrine()->getManager();
            /** @var MyNotificationRepository $myNotificationRepository */
            $myNotificationRepository = $em->getRepository('NfqNomNomBundle:MyNotification');

            $notifications = $myNotificationRepository->findByUser($user);

            $renderedContent = $this->render('NfqNomNomBundle:Default:notifications.html.twig',
                array('error' => '', 'notifications' => $notifications));
            foreach ($notifications as $notification) {
                /** @var MyNotification $notification */
                $notification->setUnread(false);
            }
            $em->flush();

            return $renderedContent;
        } else {
            return $this->render('NfqNomNomBundle:Default:index.html.twig',
                array('error' => 'log in first'));
        }
    }
}