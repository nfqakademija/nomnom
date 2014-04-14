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
        1.Soak all the fruit in the amaretto for at least 1 hour.<br />
        2.	Serve the fruit in a glass and spoon over a bit of the amaretto used to marinate the fruit in.<br />
        3.	Garnish with a sprig of mint.");
        $recipe1->setPhoto('fruitSalad.jpg');
        $recipe1->setMyRecipeCategory($this->getReference('Salad'));

        $recipe2 = new MyRecipe();
        $recipe2->setNumberOfServings(6);
        $recipe2->setRecipeName('Chicken, Silverbeet & Feta Lasagna');
        $recipe2->setPreparationTime('01:30');
        $recipe2->setPreparationInstructions("
        1.	Preheat oven to 180°C. Heat the oil in a large frying pan over medium heat. Add the onion, carrot, celery and garlic and cook, stirring, for 5 minutes or until softened. Add the chicken and cook, stirring with a wooden spoon to break up any lumps, for 5 minutes or until cooked through. Add the tomatoes and cook, stirring occasionally, for 15 minutes or until sauce thickens slight. Taste and season with salt and pepper.<br />
        2.	Meanwhile, place silverbeet in a large saucepan over high heat. Cook, covered, turning occasionally with tongs, for 5 minutes or until silverbeet wilts. Remove from heat. Drain well. Set aside to cool slightly. Use your hands to squeeze as much liquid from silverbeet as possible. Coarsely chop.<br />
        3.	Combine silverbeet, ricotta, feta and eggs in a large bowl. Season with salt and pepper.<br />
        4.	Spread a little of the chicken mixture over the base of six 10 x 18cm ovenproof dishes. Top each with a lasagna sheet, cutting to fit. Spread half the remaining mince over the lasagna sheets. Top with half the silverbeet mixture. Repeat with remaining lasagna sheets, chicken mixture and silverbeet mixture. Sprinkle with mozzarella.<br />
        5.	Place lasagnes on baking trays. Cover with foil. Bake for 20 minutes or until cooked. Uncover and cook for a further 10 minutes or until golden brown. Set aside for 5 minutes to rest before serving.
");
        $recipe2->setPhoto('lasagna.jpg');
        $recipe2->setMyRecipeCategory($this->getReference('MainDish'));

        $manager->persist($recipe1);
        $manager->persist($recipe2);
        $manager->flush();

        $this->addReference('Salads',$recipe1);
        $this->addReference('Lasagna',$recipe2);

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