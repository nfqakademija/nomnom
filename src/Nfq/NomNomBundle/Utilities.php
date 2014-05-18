<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/5/14
 * Time: 4:18 PM
 */

namespace Nfq\NomNomBundle;


use Doctrine\ORM\EntityManager;

class Utilities
{

    /**
     * @param $event
     * @param $user
     * @param EntityManager
     * @return boolean
     */
    public static function hasUserPermissionToEvent($event, $user, $em)
    {
        /** @var $em EntityManager */
        $queryResults = $em->createQuery('SELECT m FROM NfqNomNomBundle:MyUserEvent m WHERE
        m.myEvent = :event AND m.myUser = :useris')
            ->setParameters(array(
                'event' => $event,
                'useris' => $user
            ))->getResult();
        if (!empty($queryResults)) {
            return true;
        } else {
            false;
        }
    }

    public static function dateIntervalToSecond($interval)
    {
        return $interval->y * 31556926
        + $interval->m * 2629743
        + $interval->d * 86400
        + $interval->h * 3600
        + $interval->i * 60
        + $interval->s;
    }

    public static function toClosestTimeMeasure($seconds)
    {
        //unit of measurements in seconds
        $minuteSeconds = 60;
        $hourSeconds = 3600;
        $daySeconds = 86400;
        $monthSeconds = 2629743;
        $yearSeconds = 31556926;
        if ($seconds == 1) {
            $time = 1;
            $measure = 'second';
        } elseif ($seconds < $minuteSeconds) {
            $time = $seconds;
            $measure = 'seconds';
        } elseif ($seconds < 2 * $minuteSeconds) {
            $time = 1;
            $measure = 'minute';
        } elseif ($seconds < $hourSeconds) {
            $time = $seconds / $minuteSeconds;
            $measure = 'minutes';
        } elseif ($seconds < 2 * $hourSeconds) {
            $time = 1;
            $measure = 'hour';
        } elseif ($seconds < $daySeconds) {
            $time = $seconds / $hourSeconds;
            $measure = 'hours';
        } elseif ($seconds < 2 * $daySeconds) {
            $time = 1;
            $measure = 'day';
        } elseif ($seconds < $monthSeconds) {
            $time = $seconds / $daySeconds;
            $measure = 'days';
        } elseif ($seconds < 2 * $monthSeconds) {
            $time = 1;
            $measure = 'month';
        } elseif ($seconds < $yearSeconds) {
            $time = $seconds / $monthSeconds;
            $measure = 'months';
        } elseif ($seconds < 2 * $yearSeconds) {
            $time = 1;
            $measure = 'year';
        } else {
            $time = $seconds / $yearSeconds;
            $measure = 'years';
        }

        return array('time' => round($time), 'measure' => $measure);
    }

    public static function hasNotification($userEvent, $notificationName)
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