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
use Nfq\NomNomBundle\Entity\MyNotificationRepository;
use Nfq\NomNomBundle\Entity\MyUserEventRepository;
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
        /** @var MyNotificationRepository $myNotificationRepository */
        $myNotificationRepository = $em->getRepository('NfqNomNomBundle:MyNotification');
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
            $planningToEventSeconds = $this->dateIntervalToSecond($planningToEvent);

            //how much time we are going to notify that planning is ending
            //for now 10 percent of time
            $notificationTime = $planningToEventSeconds / 10;

            $nowToPlanning = date_diff($now, $endPlanningDate);
            $nowToPlanningSeconds = $this->dateIntervalToSecond($nowToPlanning);
            //TODO check is everything all right with timezones
            //set defaulttimezone by location.
            //something is woring buggy
            if ($endPlanningDate < $now) {
                $notifications = $myNotificationRepository->findByEvent($event);
                //if there are no notifications create new ones
                // this can happen when people accept invitations between notifiing and before ending
                if (empty($notifications)) {

                    $userEventsThatNeedNotification = $myUserEventRepository
                        ->findByEvent($event);

                    foreach ($userEventsThatNeedNotification as $userEvent) {
                        /** @var MyNotification $notification */
                        $notification = new MyNotification();
                        $notification->setMyUserEvent($userEvent);
                        $notification->setMyNotificationName('endPlanning');
                        $notification->setUnread(true);
                        $em->persist($notification);
                    }

                    $em->flush();
                } else {
                    foreach ($notifications as $notification) {
                        /** @var MyNotification $notification */
                        //we have to show this notification again, but the last notification disappears
                        //this way you have less notifications. that is is you haven't logged in when the
                        //notification was sent you will not see it just the second notification
                        $notification->setUnread(true);
                        $notification->setMyNotificationName('endPlanning');
                    }
                    $em->flush();
                }
                //TODO add end of event planning logic. We should place dispense all products function here

            } else {
                //check if remaining time is less than 10 percent
                if ($nowToPlanningSeconds < $notificationTime) {
                    //if there are no notifications for this event we have to create new notifications
                    //but if there is then we have to do nothing
                    $notifications = $myNotificationRepository->findByEvent($event);
                    if (empty($notifications)) {
                        //there should always be notification before this time.
                        //because we will notify when the invitation was sent
                        //but just in case
                        $userEventsThatNeedNotification = $myUserEventRepository
                            ->findByEvent($event);

                        foreach ($userEventsThatNeedNotification as $userEvent) {
                            /** @var MyNotification $notification */
                            $notification = new MyNotification();
                            $notification->setMyUserEvent($userEvent);
                            $notification->setMyNotificationName('soonEndPlanning');
                            $notification->setUnread(true);
                            $em->persist($notification);
                        }
                    } else {
                        foreach ($notifications as $notification) {
                            $notification->setUnread(true);
                            $notification->setMyNotificationName('soonEndPlanning');
                        }
                    }
                    $em->flush();
                }
            }
        }
    }

    protected function dateIntervalToSecond($interval)
    {
        return $interval->y * 31556926
        + $interval->m * 2629743
        + $interval->d * 86400
        + $interval->h * 3600
        + $interval->i * 60
        + $interval->s;
    }
} 