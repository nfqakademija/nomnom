<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/5/14
 * Time: 4:18 PM
 */

namespace Nfq\NomNomBundle;


use Doctrine\ORM\EntityManager;

class Utilities {

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
            ->setParameters( array(
                'event' => $event,
                'useris' => $user
            ))->getResult();
            if(!empty($queryResults))
            {
                return true;
            }
            else
            {
                false;
            }
    }
} 