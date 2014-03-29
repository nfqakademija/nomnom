<?php
/**
 * Created by PhpStorm.
 * User: Pimpackiukas
 * Date: 3/29/14
 * Time: 9:06 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomnomBundle\Entity\myRights;

class LoadMyRights extends AbstractFixture implements OrderedFixtureInterface
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

        $this->addReference('createEvent', $createEventRight);
        $this->addReference('sendIvitations', $sendInvitationsRight);
    }


    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}