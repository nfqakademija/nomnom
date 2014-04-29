<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MyUserEventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MyUserEventRepository extends EntityRepository
{
    public function findByEventAndUser($eventId, $userId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM NfqNomNomBundle:MyUserEvent m
            WHERE m.myEvent = :myevent AND m.myUser = :myuser')
            ->setParameters(array('myevent' => $eventId,
                'myuser' => $userId))
            ->getResult();
    }

    public function findByEventHost($eventId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM NfqNomNomBundle:MyUserEvent m
            WHERE m.myEvent = :myevent AND m.invitationStatus = 0')
            ->setParameter('myevent', $eventId)
            ->getResult();
    }

    public function findByEventInvited($eventId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM NfqNomNomBundle:MyUserEvent m
            WHERE m.myEvent = :myevent AND m.invitationStatus = 1')
            ->setParameter('myevent', $eventId)
            ->getResult();
    }

    public function findByEventAccepted($eventId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM NfqNomNomBundle:MyUserEvent m
            WHERE m.myEvent = :myevent AND m.invitationStatus = 2')
            ->setParameter('myevent', $eventId)
            ->getResult();
    }

    public function findByUserHost($userId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM NfqNomNomBundle:MyUserEvent m
            WHERE m.myUser = :myuser AND m.invitationStatus = 0')
            ->setParameter('myuser', $userId)
            ->getResult();
    }

    public function findByUserInvited($userId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM NfqNomNomBundle:MyUserEvent m
            WHERE m.myUser = :myuser AND m.invitationStatus = 1')
            ->setParameter('myuser', $userId)
            ->getResult();
    }

    public function findByUserAccepted($userId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT m FROM NfqNomNomBundle:MyUserEvent m
            WHERE m.myUser = :myuser AND m.invitationStatus = 2')
            ->setParameter('myuser', $userId)
            ->getResult();
    }

    public function getReadyPercentagePhaseTwo($eventId)
    {
        //we will count only accepted users
        $ready = $this->getEntityManager()
            ->createQuery('SELECT COUNT(m.readyToPhaseTwo) FROM NfqNomNomBundle:MyUserEvent m
            WHERE m.myEvent = :myevent AND m.readyToPhaseTwo = 1 AND m.invitationStatus = 2')
            ->setParameter('myevent', $eventId)
            ->getScalarResult()['0']['1'];

        $all = $this->getEntityManager()
            ->createQuery('SELECT COUNT(m.readyToPhaseTwo) FROM NfqNomNomBundle:MyUserEvent m
            WHERE m.myEvent = :myevent AND m.invitationStatus = 2')
            ->setParameter('myevent', $eventId)
            ->getScalarResult()['0']['1'];

        return array('ready' => $ready,
            'all' => $all);
    }

    public function getReadyPercentagePhaseThree($eventId)
    {
        //we will count only accepted users
        $ready = $this->getEntityManager()
            ->createQuery('SELECT COUNT(m.readyToPhaseThree) FROM NfqNomNomBundle:MyUserEvent m
            WHERE m.myEvent = :myevent AND m.readyToPhaseThree = 1 AND m.invitationStatus = 2')
            ->setParameter('myevent', $eventId)
            ->getScalarResult()['0']['1'];

        $all = $this->getEntityManager()
            ->createQuery('SELECT COUNT(m.readyToPhaseThree) FROM NfqNomNomBundle:MyUserEvent m
            WHERE m.myEvent = :myevent AND m.invitationStatus = 2')
            ->setParameter('myevent', $eventId)
            ->getScalarResult()['0']['1'];

        return array('ready' => $ready,
            'all' => $all);
    }
}
