<?php
/**
 * Created by PhpStorm.
 * User: Vaiva
 * Date: 4/3/14
 * Time: 2:58 PM
 */
namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use \DateTime;
use Nfq\NomnomBundle\Entity\MyRecipeCategory;

class LoadMyRecipeCategory extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $category1 = new MyRecipeCategory();
        $category1->setCategoryName('Side dish');

        $category2 = new MyRecipeCategory();
        $category2->setCategoryName('Main dish');

        $category3 = new MyRecipeCategory();
        $category2->setCategoryName('Deserts');

        $manager->persist($category1);
        $manager->persist($category2);
        $manager->persist($category3);
        $manager->flush();

        $this->addReference('Salad',$category1);
        $this->addReference('MainDish',$category2);
        $this->addReference('Deserts', $category3);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 10;
    }
}