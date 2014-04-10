<?php
/**
 * Created by PhpStorm.
 * User: kodvin
 * Date: 3/29/14
 * Time: 9:06 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomnomBundle\Entity\MyRight;

class LoadMyRights extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)

    {
        $createEventRight = new MyRight();
        $createEventRight->setRightName("createEvent");

        $sendInvitationsRight = new MyRight();
        $sendInvitationsRight->setRightName("sendInvitations");

        $manager->persist($sendInvitationsRight);
        $manager->persist($createEventRight);
        $manager->flush();

        $this->addReference('createEvent', $createEventRight);
        $this->addReference('sendInvitations', $sendInvitationsRight);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}