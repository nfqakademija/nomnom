<?php
/**
 * Created by PhpStorm.
 * User: Andrius
 * Date: 5/4/14
 * Time: 2:36 AM
 */

namespace Nfq\NomNomBundle\Twig;


use Doctrine\ORM\EntityManager;
use Nfq\NomNomBundle\Entity\MyNotification;
use Nfq\NomNomBundle\Entity\MyNotificationRepository;
use Nfq\NomNomBundle\Utilities;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Twig_Extension;
use Twig_SimpleFunction;

class NfqExtension extends Twig_Extension
{
    protected $doctrine;

    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('notificationCheck', array($this, 'notificationCheck')),
            new Twig_SimpleFunction('notificationClosestTimeInterval', array($this, 'notificationClosestTimeInterval'))
        );
    }

    public function notificationCheck($user)
    {
        /** @var EntityManager $em */
        $em = $this->doctrine->getManager();
        /** @var MyNotificationRepository $myNotificationsRepository */
        $myNotificationsRepository = $em->getRepository('NfqNomNomBundle:MyNotification');
        /** @var MyNotification $notification */
        return $notification = $myNotificationsRepository->findByUserUnread($user, true);
    }

    /** @param MyNotification $notification */
    public function notificationClosestTimeInterval($notification)
    {
        $now = new \Datetime();
        $timeInterval = $now->diff($notification->getNotificationDate());
        $timeIntervalSeconds = Utilities::dateIntervalToSecond($timeInterval);
        return Utilities::toClosestTimeMeasure($timeIntervalSeconds);
    }

    public function getName()
    {
        return 'nfw_extension';
    }
}