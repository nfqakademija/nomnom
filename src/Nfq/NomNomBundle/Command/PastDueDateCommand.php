<?php
/**
 * Created by PhpStorm.
 * User: Andrius
 * Date: 4/29/14
 * Time: 2:00 PM
 */

namespace Nfq\NomNomBundle\Command;


use Doctrine\ORM\EntityManager;
use Nfq\NomNomBundle\Entity\MyEvent;
use Nfq\NomNomBundle\Entity\MyEventRepository;
use Nfq\NomNomBundle\Entity\MyNotification;
use Nfq\NomNomBundle\Entity\MyUserEvent;
use Nfq\NomNomBundle\Entity\MyUserEventRepository;
use Nfq\NomNomBundle\Utilities;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PastDueDateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('nomnom:datecheck')
            ->setDescription('Check if the due date has passed');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var EntityManager $em */
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        /** @var MyEventRepository $myEventRepository */
        $myEventRepository = $em->getRepository('NfqNomNomBundle:MyEvent');
        /** @var MyUserEventRepository $myUserEventRepository */
        $myUserEventRepository = $em->getRepository('NfqNomNomBundle:MyUserEvent');
        $events = $myEventRepository->findAll();

        $now = new \DateTime();
        foreach ($events as $event) {
            /** @var MyEvent $event */
            $endPlanningDate = $event->getEventPlanningDueDate();
            $eventDate = $event->getEventDate();

            //we assume that event date is further in time than planing
            $planningToEvent = date_diff($endPlanningDate, $eventDate);
            $planningToEventSeconds = Utilities::dateIntervalToSecond($planningToEvent);

            //how much time we are going to notify that planning is ending
            //for now 10 percent of time
            $notificationTime = $planningToEventSeconds / 10;

            $nowToPlanning = date_diff($now, $endPlanningDate);
            $nowToPlanningSeconds = Utilities::dateIntervalToSecond($nowToPlanning);
            //TODO check is everything all right with timezones
            //set defaulttimezone by location.
            //something is woring buggy
            if ($endPlanningDate < $now) {
                //that  means that we have to force the event to end
                if ($event->getEventPhase() != MyEvent::PHASE_ENDED) {
                    $event->setEventPhase(MyEvent::PHASE_ENDED);
                }
                $userEventsThatNeedNotification = $myUserEventRepository
                    ->findByEvent($event);

                $notificationName = 'endPlanning';
                foreach ($userEventsThatNeedNotification as $userEvent) {
                    if (!$this->hasNotification($userEvent, $notificationName)) {
                        $notification = new MyNotification();
                        $notification->setMyUserEvent($userEvent);
                        $notification->setMyNotificationName($notificationName);
                        $notification->setUnread(true);
                        $em->persist($notification);
                    }
                }
            } else {
                //check if remaining time is less than 10 percent
                if ($nowToPlanningSeconds < $notificationTime) {
                    $userEventsThatNeedNotification = $myUserEventRepository
                        ->findByEvent($event);

                    $notificationName = 'soonEndPlanning';
                    foreach ($userEventsThatNeedNotification as $userEvent) {
                        if (!$this->hasNotification($userEvent, $notificationName)) {
                            $notification = new MyNotification();
                            $notification->setMyUserEvent($userEvent);
                            $notification->setMyNotificationName($notificationName);
                            $notification->setUnread(true);
                            $em->persist($notification);
                        }
                    }
                }
            }
            $em->flush();
        }
    }

    protected function hasNotification($userEvent, $notificationName)
    {
        /** @var MyUserEvent $userEvent */
        $notifications = $userEvent->getMyNotifications();
        foreach ($notifications as $notification) {
            /** @var MyNotification $notification */
            if ($notification->getMyNotificationName() == $notificationName) {
                return true;
            }
        }
        return false;
    }
}