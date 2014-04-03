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
        $recipe1->setRecipeName('Karališkieji kotletai');
        $recipe1->setPreparationTime('00:45');
        $recipe1->setPreparationInstructions('Gaminimo eiga:
1.	Svogūną susmulkinti ir sumaišyti su mėsa. Tada supilti 1 kiaušinio baltymą, berti žiupsnį druskos, dėti apie 2 šaukštus miltų, sudėti piene išmirkytą batono riekę, pagardinti druska ir pipirais. Masę kruopščiai išminkykite rankomis.
2.	Sūrį sutarkuoti smulkia tarka ir sumaišyti su trintu česnaku, kiaušinio tryniu ir smulkintais krapais.
3.	Iš mėsos daryti delno dydžio paplotį, dėti įdarą ir suformuoti kotletus.
4.	Kotletus apvolioti džiūvėsiuose ir kepti įkaitintame aliejuje iš abiejų pusių.');
        $recipe1->setFoto('lala');
        $recipe1->getMyRecipeCategory();


        $manager->persist($recipe1);
        $manager->flush();

        $this->addReference('Kotletai',$recipe1);
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