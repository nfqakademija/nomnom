<?php
/**
 * Created by PhpStorm.
 * User: zezima
 * Date: 4/3/14
 * Time: 6:05 PM
 */
namespace Nfq\NomNomBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomNomBundle\Entity\MyRecipeCategory;


class LoadMyRecipeCategory extends AbstractFixture implements OrderedFixtureInterface
{


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $cat1 = new MyRecipeCategory();
        $cat2 = new MyRecipeCategory();
        $cat3 = new MyRecipeCategory();

        $cat1->setCategoryName('snacks');
        $cat2->setCategoryName('appetizers');
        $cat3->setCategoryName('soups');

        $manager->persist($cat1);
        $manager->persist($cat2);
        $manager->persist($cat3);
        $manager->flush();

        $this->addReference('Snacks', $cat1);
        $this->addReference('appetizers', $cat2);
        $this->addReference('soups', $cat3);


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