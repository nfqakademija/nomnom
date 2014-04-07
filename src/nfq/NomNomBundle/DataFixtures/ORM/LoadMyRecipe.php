<?php
/**
 * Created by PhpStorm.
 * User: Vaiva
 * Date: 4/3/14
 * Time: 8:19 AM
 */
namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use \DateTime;
use Nfq\NomnomBundle\Entity\MyRecipe;

class LoadMyRecipes extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {

        $recipe1 = new MyRecipe();
        $recipe1->setNumberOfServings(4);
        $recipe1->setRecipeName('Fruit Salad');
        $recipe1->setPreparationTime('01:00');
        $recipe1->setPreparationInstructions("
        1.Soak all the fruit in the amaretto for at least 1 hour.
        2.	Serve the fruit in a glass and spoon over a bit of the amaretto used to marinate the fruit in.
        3.	Garnish with a sprig of mint.");
        $recipe1->setPhoto('fruit salad.jpg');
        $recipe1->setMyRecipeCategory($this->getReference('Salad'));

        $manager->persist($recipe1);
        $manager->flush();

        $this->addReference('Salads',$recipe1);

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