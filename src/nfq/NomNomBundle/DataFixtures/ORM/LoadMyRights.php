<?php
/**
 * Created by PhpStorm.
 * User: Pimpackiukas
 * Date: 3/29/14
 * Time: 9:06 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomnomBundle\Entity\myRights;

class LoadMyRights implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
       $createEventRight = new myRights();
       $createEventRight->setRightName("createEvent");

       $sendInvitationsRight = new myRights();
       $sendInvitationsRight->setRightName("sendIvitations");

       $manager->persist($sendInvitationsRight);
       $manager->persist($createEventRight);
       $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}