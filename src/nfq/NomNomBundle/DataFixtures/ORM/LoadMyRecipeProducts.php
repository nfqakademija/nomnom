<?php
/**
 * Created by PhpStorm.
 * User: Vaiva
 * Date: 4/3/14
 * Time: 2:45 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomnomBundle\Entity\MyRecipeProduct;

class LoadMyRecipeProducts extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $dish1 = new MyRecipeProduct();
        $dish1->setQuantity(350);
        $dish1->setQuantityMeasure(1);
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod */
        $prod = $this->getReference('MaltaMėsa');
        $dish1->setMyProduct($prod);
        $dish1->setMyRecipe($this->getReference('Kotletai'));

        $manager->persist($dish1);
        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 11;
    }
}