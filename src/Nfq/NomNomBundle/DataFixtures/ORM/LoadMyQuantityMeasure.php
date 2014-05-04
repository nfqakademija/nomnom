<?php
/**
 * Created by PhpStorm.
 * User: Pimpackiukas
 * Date: 4/29/14
 * Time: 7:56 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomNomBundle\Entity\MyQuantityMeasure;

class LoadMyQuantityMeasure extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 6;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $measure0 = new MyQuantityMeasure();
        $measure0->setMyQuantityMeasureName('');

        $measure1 = new MyQuantityMeasure();
        $measure1->setMyQuantityMeasureName('g');

        $measure2 = new MyQuantityMeasure();
        $measure2->setMyQuantityMeasureName('tbsp');

        $measure3 = new MyQuantityMeasure();
        $measure3->setMyQuantityMeasureName('stalk');

        $measure4 = new MyQuantityMeasure();
        $measure4->setMyQuantityMeasureName('kg');

        $measure5 = new MyQuantityMeasure();
        $measure5->setMyQuantityMeasureName('bunch');

        $manager->persist($measure0);
        $manager->persist($measure1);
        $manager->persist($measure2);
        $manager->persist($measure3);
        $manager->persist($measure4);
        $manager->persist($measure5);

        $manager->flush();

        $this->addReference('empty', $measure0);
        $this->addReference('g', $measure1);
        $this->addReference('tbsp', $measure2);
        $this->addReference('stalk', $measure3);
        $this->addReference('kg', $measure4);
        $this->addReference('bunch', $measure5);
    }
}