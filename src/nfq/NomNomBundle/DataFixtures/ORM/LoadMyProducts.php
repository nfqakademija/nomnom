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
        $banana->setProductName('banana');

        $fish = new MyProduct();
        $fish->setProductName('fish');

        $mince = new MyProduct();
        $mince->setProductName('mince');

        $egg = new MyProduct();
        $egg->setProductName('egg');

        $onion = new MyProduct();
        $onion->setProductName('onion');

        $garlic = new MyProduct();
        $garlic->setProductName('garlic');

        $blackPepper = new MyProduct();
        $blackPepper->setProductName('black pepper');

        $flour = new MyProduct();
        $flour->setProductName('flavour');

        $whiteBread = new MyProduct();
        $whiteBread->setProductName('white bread');

        $salt = new MyProduct();
        $salt->setProductName('salt');

        $oil = new MyProduct();
        $oil->setProductName('oil');

        $cheese = new MyProduct();
        $cheese->setProductName('cheese');

        $breadcrumbs = new MyProduct();
        $breadcrumbs->setProductName('breadcrumbs');

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


        $manager->persist($banana);
        $manager->persist($fish);
        $manager->persist($mince);
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
        $manager->flush();

        $this->addReference('fish',$fish);
        $this->addReference('banana',$banana);
        $this->addReference('mince',$mince);
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