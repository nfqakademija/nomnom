<?php
/**
 * Created by PhpStorm.
 * User: kodvin
 * Date: 3/29/14
 * Time: 10:02 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomnomBundle\Entity\myRoles;

class LoadMyRoles extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $registeredUser = new myRoles();
        $registeredUser->setRoleName("registeredUser");

        $guest = new myRoles();
        $guest->setRoleName("guest");

        $manager->persist($guest);
        $manager->persist($registeredUser);
        $manager->flush();

        $this->addReference("registeredUser",$registeredUser);
        $this->addReference("guest",$guest);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }
}