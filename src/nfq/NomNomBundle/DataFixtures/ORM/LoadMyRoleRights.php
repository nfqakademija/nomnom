<?php
/**
 * Created by PhpStorm.
 * User: kodvin
 * Date: 3/29/14
 * Time: 10:13 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomnomBundle\Entity\MyRoleRight;

class LoadMyRoleRights extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $firstRR = new MyRoleRight();
        $firstRR->setMyRight($this->getReference('createEvent'));
        $firstRR->setMyRole($this->getReference('registeredUser'));

        $secondRR = new MyRoleRight();
        $secondRR->setMyRight($this->getReference('sendInvitations'));
        $secondRR->setMyRole($this->getReference('guest'));

        $manager->persist($secondRR);
        $manager->persist($firstRR);
        $manager->flush();

        $this->addReference('firstRoleRights',$firstRR);
        $this->addReference('secondRoleRights',$secondRR);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 3;
    }
}