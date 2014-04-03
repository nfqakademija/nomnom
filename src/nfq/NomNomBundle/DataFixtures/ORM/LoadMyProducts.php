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
        $mince->setProductName('Malta mėsa');

        $egg = new MyProduct();
        $egg->setProductName('Kiaušinis');

        $onion = new MyProduct();
        $onion->setProductName('Svogūnas');

        $garlic = new MyProduct();
        $garlic->setProductName('Česnakas');

        $blackPepper = new MyProduct();
        $blackPepper->setProductName('Juodieji piprai');

        $flour = new MyProduct();
        $flour->setProductName('Miltai');

        $whiteBread = new MyProduct();
        $whiteBread->setProductName('Balta duona');

        $salt = new MyProduct();
        $salt->setProductName('Druska');

        $oil = new MyProduct();
        $oil->setProductName('Aliejus');

        $cheese = new MyProduct();
        $cheese->setProductName('Fermentinis sūris');

        $breadcrumbs = new MyProduct();
        $breadcrumbs->setProductName('Džiūvėsėliai');


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
        $manager->flush();

        $this->addReference('fish',$fish);
        $this->addReference('banana',$banana);
        $this->addReference('MaltaMėsa',$mince);
        $this->addReference('Kiaušinis',$egg);
        $this->addReference('Svogūnas',$onion);
        $this->addReference('Česnakas',$garlic);
        $this->addReference('JuodiejiPipirai',$blackPepper);
        $this->addReference('Miltai',$flour);
        $this->addReference('BaltaDuona',$whiteBread);
        $this->addReference('Druska',$salt);
        $this->addReference('Aliejus',$oil);
        $this->addReference('Sūris',$cheese);
        $this->addReference('Džiūvėsėliai',$breadcrumbs);

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