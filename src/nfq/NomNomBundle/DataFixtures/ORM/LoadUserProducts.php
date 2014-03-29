<?php
/**
 * Created by PhpStorm.
 * User: kodvin
 * Date: 3/29/14
 * Time: 11:46 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomnomBundle\Entity\myUserProducts;


class LoadUserProducts extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $userproduct = new myUserProducts();
        $userproduct->setMyproducts($this->getReference('fish'));
        $userproduct->setQuantity(200.0);
        $userproduct->setQuantityMeasure(2);

        $userproduct2 = new myUserProducts();
        $userproduct2->setMyproducts($this->getReference('banana'));
        $userproduct2->setQuantity(150);
        $userproduct2->setQuantityMeasure(1);

        $manager->persist($userproduct);
        $manager->persist($userproduct2);
        $manager->flush();

        $this->addReference('userproduct',$userproduct);
        $this->addReference('userproduct2',$userproduct2);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 8;
    }
}