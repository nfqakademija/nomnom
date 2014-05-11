<?php
/**
 * Created by PhpStorm.
 * User: Vaiva
 * Date: 4/2/14
 * Time: 7:24 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;


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