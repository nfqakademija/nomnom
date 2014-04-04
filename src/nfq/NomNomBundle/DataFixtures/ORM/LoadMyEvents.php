<?php
/**
 * Created by PhpStorm.
 * User: Vaiva
 * Date: 4/2/14
 * Time: 7:24 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use \DateTime;
use Nfq\NomNomBundle\Entity\MyEvent;

class LoadMyEvents extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {

        $event1 = new MyEvent();
        $event1->setDateCreated(new DateTime());
        $event1->setEventName('Gimtadienis');
        $event1->setEventDate(new DateTime('2014-05-01 19:00'));
        $event1->setEvenPhases(0);

        $event2 = new MyEvent();
        $event2->setDateCreated(new DateTime());
        $event2->setEventName('Įkurtuvės');
        $event2->setEventDate(new DateTime('2014-04-15 16:30'));
        $event2->setEvenPhases(0);


        $manager->persist($event1);
        $manager->persist($event2);
        $manager->flush();

        $this->addReference('Gimtadienis',$event1);
        $this->addReference('Įkurtuvės',$event2);

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 9;
    }
}