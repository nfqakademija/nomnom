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
use Nfq\NomnomBundle\Entity\MyUserProfile;

class LoadUserProfile extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $userprofile = new MyUserProfile();
        $userprofile->setAvatar('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
AAAASUVORK5CYII=');

        $userprofile2 = new MyUserProfile();
        $userprofile2->setAvatar('galirsitastiks');

        $userprofile3 = new MyUserProfile();
        $userprofile3->setAvatar('galirsitastiks');

        $userprofile4 = new MyUserProfile();
        $userprofile4->setAvatar('galirsitastiks');

        $manager->persist($userprofile);
        $manager->persist($userprofile2);
        $manager->persist($userprofile3);
        $manager->persist($userprofile4);
        $manager->flush();

        $this->addReference('userProfile', $userprofile);
        $this->addReference('userProfile2', $userprofile2);
        $this->addReference('userProfile3', $userprofile3);
        $this->addReference('userProfile4', $userprofile4);
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