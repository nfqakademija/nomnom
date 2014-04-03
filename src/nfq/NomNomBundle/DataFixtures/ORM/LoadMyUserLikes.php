<?php
/**
 * Created by PhpStorm.
 * User: kodvin
 * Date: 3/29/14
 * Time: 9:27 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomnomBundle\Entity\MyUserLike;

class LoadMyUserLikes extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $bananaLike = new MyUserLike();
        $bananaLike->setFood("banana")->setLikeOrDislike(1);
        $bananaLike->setMyUserProfile($this->getReference('userProfile'));

        $fishDislike = new MyUserLike();
        $fishDislike->setFood("fish")->setLikeOrDislike(0);
        $fishDislike->setMyUserProfile($this->getReference('userProfile2'));

        $manager->persist($bananaLike);
        $manager->persist($fishDislike);
        $manager->flush();

        $this->addReference("bananaLikes", $bananaLike);
        $this->addReference("fishDislikes", $fishDislike);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 6; // the order in which fixtures will be loaded
    }
}