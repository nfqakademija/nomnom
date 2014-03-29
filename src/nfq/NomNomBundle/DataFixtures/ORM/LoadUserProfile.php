<?php
/**
 * Created by PhpStorm.
 * User: Pimpackiukas
 * Date: 3/29/14
 * Time: 11:13 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomnomBundle\Entity\myUserProfile;
class LoadUserProfile extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $userprofile = new myUserProfile();
        $userprofile->setAvatar('pradziabusgerai');

        $userprofile2 = new myUserProfile();
        $userprofile2->setAvatar('galirsitastiks');

        $manager->persist($userprofile);
        $manager->persist($userprofile2);
        $manager->flush();

        $this->addReference('userProfile',$userprofile);
        $this->addReference('userProfile2',$userprofile2);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 4;
    }
}