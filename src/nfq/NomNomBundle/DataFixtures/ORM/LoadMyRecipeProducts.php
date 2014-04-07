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
        $dish1->setQuantity(5);
        $dish1->setQuantityMeasure(2);
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod1 */
        $prod1 = $this->getReference('amaretoLiquor');
        $dish1->setMyProduct($prod1);
        $dish1->setMyRecipe($this->getReference('Salads'));

        $dish2 = new MyRecipeProduct();
        $dish2->setQuantity(200);
        $dish2->setQuantityMeasure(1);
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod2 */
        $prod2 = $this->getReference('strawberries');
        $dish2->setMyProduct($prod2);
        $dish2->setMyRecipe($this->getReference('Salads'));

        $dish3 = new MyRecipeProduct();
        $dish3->setQuantity(200);
        $dish3->setQuantityMeasure(1);
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod3 */
        $prod3 = $this->getReference('blueberries');
        $dish3->setMyProduct($prod3);
        $dish3->setMyRecipe($this->getReference('Salads'));

        $dish4 = new MyRecipeProduct();
        $dish4->setQuantity(200);
        $dish4->setQuantityMeasure(1);
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod4 */
        $prod4 = $this->getReference('melon');
        $dish4->setMyProduct($prod4);
        $dish4->setMyRecipe($this->getReference('Salads'));

        $dish5 = new MyRecipeProduct();
        $dish5->setQuantity(0);
        $dish5->setQuantityMeasure(0);
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod5 */
        $prod5 = $this->getReference('mint');
        $dish5->setMyProduct($prod5);
        $dish5->setMyRecipe($this->getReference('Salads'));

        $manager->persist($dish1);
        $manager->persist($dish2);
        $manager->persist($dish3);
        $manager->persist($dish4);
        $manager->persist($dish5);
        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 12;
    }
}