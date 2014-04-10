<?php
/**
 * Created by PhpStorm.
 * User: kodvin
 * Date: 3/29/14
 * Time: 10:27 PM
 */

namespace Nfq\NomNomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nfq\NomnomBundle\Entity\User;

class LoadUser extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $userManager = $this->container->get('fos_user.user_manager');

        // Create a new user
        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setEmail('admin@domain.com');
        $user->setPlainPassword('admin_password');
        $user->setEnabled(true);
        $user->setMyuserprofile($this->getReference('userProfile'));
        $userManager->updateUser($user);

        // Create a new user
        $user2 = $userManager->createUser();
        $user2->setUsername('user');
        $user2->setEmail('user@domain.com');
        $user2->setPlainPassword('user_password');
        $user2->setEnabled(true);
        $user2->setMyuserprofile($this->getReference('userProfile2'));
        $userManager->updateUser($user2);

        // Create a new user
        $user3 = $userManager->createUser();
        $user3->setUsername('jonas');
        $user3->setEmail('jonas@domain.com');
        $user3->setPlainPassword('jonas');
        $user3->setEnabled(true);
        $user3->setMyuserprofile($this->getReference('userProfile3'));
        $userManager->updateUser($user3);

        // Create a new user
        $user4 = $userManager->createUser();
        $user4->setUsername('petras');
        $user4->setEmail('petras@domain.com');
        $user4->setPlainPassword('petras');
        $user4->setEnabled(true);
        $user4->setMyuserprofile($this->getReference('userProfile4'));
        $userManager->updateUser($user4);

        $this->addReference('user', $user);
        $this->addReference('user2', $user2);
        $this->addReference('user3', $user3);
        $this->addReference('user4', $user4);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 5;
    }
}
