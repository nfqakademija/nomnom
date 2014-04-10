<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyUserProfile
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyUserProfileRepository")
 */
class MyUserProfile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="myUserProfile")
     */
    private $myUser;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="blob")
     */
    private $avatar;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return MyUserProfile
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }


    /**
     * Set myUser
     *
     * @param \Nfq\NomNomBundle\Entity\User $myUser
     * @return MyUserProfile
     */
    public function setMyUser(\Nfq\NomNomBundle\Entity\User $myUser = null)
    {
        $this->myUser = $myUser;

        return $this;
    }

    /**
     * Get myUser
     *
     * @return \Nfq\NomNomBundle\Entity\User
     */
    public function getMyUser()
    {
        return $this->myUser;
    }
}
