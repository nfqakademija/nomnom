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

class LoadMyRecipeProducts extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $dish1 = new MyRecipeProduct();
        $dish1->setQuantity(5);
        $dish1->setMyQuantityMeasure($this->getReference('tbsp'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod1 */
        $prod1 = $this->getReference('amaretoLiquor');
        $dish1->setMyProduct($prod1);
        $dish1->setMyRecipe($this->getReference('Salads'));

        $dish2 = new MyRecipeProduct();
        $dish2->setQuantity(200);
        $dish2->setMyQuantityMeasure($this->getReference('g'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod2 */
        $prod2 = $this->getReference('strawberries');
        $dish2->setMyProduct($prod2);
        $dish2->setMyRecipe($this->getReference('Salads'));

        $dish3 = new MyRecipeProduct();
        $dish3->setQuantity(200);
        $dish3->setMyQuantityMeasure($this->getReference('g'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod3 */
        $prod3 = $this->getReference('blueberries');
        $dish3->setMyProduct($prod3);
        $dish3->setMyRecipe($this->getReference('Salads'));

        $dish4 = new MyRecipeProduct();
        $dish4->setQuantity(200);
        $dish4->setMyQuantityMeasure($this->getReference('g'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod4 */
        $prod4 = $this->getReference('melon');
        $dish4->setMyProduct($prod4);
        $dish4->setMyRecipe($this->getReference('Salads'));

        $dish5 = new MyRecipeProduct();
        $dish5->setQuantity(0);
        $dish5->setMyQuantityMeasure($this->getReference('empty'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod5 */
        $prod5 = $this->getReference('mint');
        $dish5->setMyProduct($prod5);
        $dish5->setMyRecipe($this->getReference('Salads'));

        $dish6 = new MyRecipeProduct();
        $dish6->setQuantity(1);
        $dish6->setMyQuantityMeasure($this->getReference('tbsp'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod6 */
        $prod6 = $this->getReference('oliveOil');
        $dish6->setMyProduct($prod6);
        $dish6->setMyRecipe($this->getReference('Lasagna'));

        $dish7 = new MyRecipeProduct();
        $dish7->setQuantity(1);
        $dish7->setMyQuantityMeasure($this->getReference('empty'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod7 */
        $prod7 = $this->getReference('onion');
        $dish7->setMyProduct($prod7);
        $dish7->setMyRecipe($this->getReference('Lasagna'));

        $dish8 = new MyRecipeProduct();
        $dish8->setQuantity(1);
        $dish8->setMyQuantityMeasure($this->getReference('empty'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod8 */
        $prod8 = $this->getReference('carrot');
        $dish8->setMyProduct($prod8);
        $dish8->setMyRecipe($this->getReference('Lasagna'));

        $dish9 = new MyRecipeProduct();
        $dish9->setQuantity(2);
        $dish9->setMyQuantityMeasure($this->getReference('empty'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod9 */
        $prod9 = $this->getReference('stalksCelery');
        $dish9->setMyProduct($prod9);
        $dish9->setMyRecipe($this->getReference('Lasagna'));

        $dish10 = new MyRecipeProduct();
        $dish10->setQuantity(2);
        $dish10->setMyQuantityMeasure($this->getReference('stalk'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod10 */
        $prod10 = $this->getReference('garlic');
        $dish10->setMyProduct($prod10);
        $dish10->setMyRecipe($this->getReference('Lasagna'));

        $dish11 = new MyRecipeProduct();
        $dish11->setQuantity(600);
        $dish11->setMyQuantityMeasure($this->getReference('g'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod11 */
        $prod11 = $this->getReference('chickenMince');
        $dish11->setMyProduct($prod11);
        $dish11->setMyRecipe($this->getReference('Lasagna'));

        $dish12 = new MyRecipeProduct();
        $dish12->setQuantity(400);
        $dish12->setMyQuantityMeasure($this->getReference('g'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod12 */
        $prod12 = $this->getReference('tomato');
        $dish12->setMyProduct($prod12);
        $dish12->setMyRecipe($this->getReference('Lasagna'));

        $dish13 = new MyRecipeProduct();
        $dish13->setQuantity(1);
        $dish13->setMyQuantityMeasure($this->getReference('empty'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod13 */
        $prod13 = $this->getReference('silverbeet');
        $dish13->setMyProduct($prod13);
        $dish13->setMyRecipe($this->getReference('Lasagna'));

        $dish14 = new MyRecipeProduct();
        $dish14->setQuantity(1);
        $dish14->setMyQuantityMeasure($this->getReference('kg'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod14 */
        $prod14 = $this->getReference('ricotta');
        $dish14->setMyProduct($prod14);
        $dish14->setMyRecipe($this->getReference('Lasagna'));

        $dish15 = new MyRecipeProduct();
        $dish15->setQuantity(200);
        $dish15->setMyQuantityMeasure($this->getReference('g'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod15 */
        $prod15 = $this->getReference('feta');
        $dish15->setMyProduct($prod15);
        $dish15->setMyRecipe($this->getReference('Lasagna'));

        $dish16 = new MyRecipeProduct();
        $dish16->setQuantity(2);
        $dish16->setMyQuantityMeasure($this->getReference('empty'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod16 */
        $prod16 = $this->getReference('egg');
        $dish16->setMyProduct($prod16);
        $dish16->setMyRecipe($this->getReference('Lasagna'));

        $dish17 = new MyRecipeProduct();
        $dish17->setQuantity(12);
        $dish17->setMyQuantityMeasure($this->getReference('empty'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod17 */
        $prod17 = $this->getReference('lasagnaSheets');
        $dish17->setMyProduct($prod17);
        $dish17->setMyRecipe($this->getReference('Lasagna'));

        $dish18 = new MyRecipeProduct();
        $dish18->setQuantity(100);
        $dish18->setMyQuantityMeasure($this->getReference('g'));
        /** @var \Nfq\NomNomBundle\Entity\MyProduct $prod18 */
        $prod18 = $this->getReference('mozzarella');
        $dish18->setMyProduct($prod18);
        $dish18->setMyRecipe($this->getReference('Lasagna'));

        $manager->persist($dish1);
        $manager->persist($dish2);
        $manager->persist($dish3);
        $manager->persist($dish4);
        $manager->persist($dish5);
        $manager->persist($dish6);
        $manager->persist($dish7);
        $manager->persist($dish8);
        $manager->persist($dish9);
        $manager->persist($dish10);
        $manager->persist($dish11);
        $manager->persist($dish12);
        $manager->persist($dish13);
        $manager->persist($dish14);
        $manager->persist($dish15);
        $manager->persist($dish16);
        $manager->persist($dish17);
        $manager->persist($dish18);
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