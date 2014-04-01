<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="MyUserLike", mappedBy="myUserProfile")
     */
    private $myUserLikes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myUserLikes = new ArrayCollection();
    }

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

    /**
     * Add myUserLikes
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserLike $myUserLikes
     * @return MyUserProfile
     */
    public function addMyUserLike(\Nfq\NomNomBundle\Entity\MyUserLike $myUserLikes)
    {
        $this->myUserLikes[] = $myUserLikes;

        return $this;
    }

    /**
     * Remove myUserLikes
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserLike $myUserLikes
     */
    public function removeMyUserLike(\Nfq\NomNomBundle\Entity\MyUserLike $myUserLikes)
    {
        $this->myUserLikes->removeElement($myUserLikes);
    }

    /**
     * Get myUserLikes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyUserLikes()
    {
        return $this->myUserLikes;
    }
}
