<?php
/**
 * Created by PhpStorm.
 * User: kodvin
 * Date: 3/29/14
 * Time: 11:40 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomnomBundle\Entity\MyProduct;

class LoadMyProducts extends AbstractFixture implements OrderedFixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $banana = new MyProduct();
        $banana->setProductName('Banana');

        $fish = new MyProduct();
        $fish->setProductName('Fish');

        $chickenMince = new MyProduct();
        $chickenMince->setProductName('Chicken mince');

        $egg = new MyProduct();
        $egg->setProductName('Egg');

        $onion = new MyProduct();
        $onion->setProductName('Onion');

        $garlic = new MyProduct();
        $garlic->setProductName('Garlic');

        $blackPepper = new MyProduct();
        $blackPepper->setProductName('Black pepper');

        $flour = new MyProduct();
        $flour->setProductName('Flavour');

        $whiteBread = new MyProduct();
        $whiteBread->setProductName('White bread');

        $salt = new MyProduct();
        $salt->setProductName('Salt');

        $oil = new MyProduct();
        $oil->setProductName('Oil');

        $cheese = new MyProduct();
        $cheese->setProductName('Cheese');

        $breadcrumbs = new MyProduct();
        $breadcrumbs->setProductName('Breadcrumbs');

        $amaretoLiquor = new MyProduct();
        $amaretoLiquor->setProductName('Amareto Liquor');

        $strawberries = new MyProduct();
        $strawberries->setProductName('Strawberries');

        $blueberries = new MyProduct();
        $blueberries->setProductName('Blueberries');

        $melon = new MyProduct();
        $melon->setProductName('Melon');

        $mint = new MyProduct();
        $mint->setProductName('Mint');

        $oliveOil = new MyProduct();
        $oliveOil->setProductName('Olive oil');

        $carrot = new MyProduct();
        $carrot->setProductName('Carrot');

        $stalksCelery = new MyProduct();
        $stalksCelery->setProductName('Stalks Celery');

        $tomato = new MyProduct();
        $tomato->setProductName('Tomatoes');

        $silverbeet = new MyProduct();
        $silverbeet->setProductName('Silverbeet');

        $ricotta = new MyProduct();
        $ricotta->setProductName('Ricotta');

        $feta = new MyProduct();
        $feta->setProductName('Feta');

        $lasagnaSheets = new MyProduct();
        $lasagnaSheets->setProductName('Lasagna sheets');

        $mozzarella = new MyProduct();
        $mozzarella->setProductName('Mozarella');


        $manager->persist($banana);
        $manager->persist($fish);
        $manager->persist($chickenMince);
        $manager->persist($egg);
        $manager->persist($onion);
        $manager->persist($garlic);
        $manager->persist($blackPepper);
        $manager->persist($flour);
        $manager->persist($whiteBread);
        $manager->persist($salt);
        $manager->persist($oil);
        $manager->persist($cheese);
        $manager->persist($breadcrumbs);
        $manager->persist($amaretoLiquor);
        $manager->persist($strawberries);
        $manager->persist($blueberries);
        $manager->persist($melon);
        $manager->persist($mint);
        $manager->persist($oliveOil);
        $manager->persist($carrot);
        $manager->persist($stalksCelery);
        $manager->persist($tomato);
        $manager->persist($silverbeet);
        $manager->persist($ricotta);
        $manager->persist($feta);
        $manager->persist($lasagnaSheets);
        $manager->persist($mozzarella);

        $manager->flush();

        $this->addReference('fish',$fish);
        $this->addReference('banana',$banana);
        $this->addReference('chickenMince',$chickenMince);
        $this->addReference('egg',$egg);
        $this->addReference('onion',$onion);
        $this->addReference('garlic',$garlic);
        $this->addReference('blackPepper',$blackPepper);
        $this->addReference('flour',$flour);
        $this->addReference('whiteBread',$whiteBread);
        $this->addReference('salt',$salt);
        $this->addReference('oil',$oil);
        $this->addReference('cheese',$cheese);
        $this->addReference('breadcrumbs',$breadcrumbs);
        $this->addReference('amaretoLiquor',$amaretoLiquor);
        $this->addReference('strawberries', $strawberries);
        $this->addReference('blueberries', $blueberries);
        $this->addReference('melon', $melon);
        $this->addReference('mint', $mint);
        $this->addReference('oliveOil', $oliveOil);
        $this->addReference('carrot',$carrot);
        $this->addReference('stalksCelery',$stalksCelery);
        $this->addReference('tomato',$tomato);
        $this->addReference('silverbeet',$silverbeet);
        $this->addReference('ricotta',$ricotta);
        $this->addReference('feta',$feta);
        $this->addReference('lasagnaSheets',$lasagnaSheets);
        $this->addReference('mozzarella',$mozzarella);


    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 7;
    }
}