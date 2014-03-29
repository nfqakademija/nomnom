<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * myUserProfile
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myUserProfileRepository")
 */
class myUserProfile
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
     * @ORM\OneToOne(targetEntity="User", mappedBy="myuserprofile")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="blob")
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity="myUserLikes", mappedBy="myuserprofile")
     */
    private $myuserlikes;

    public function __construct()
    {
        $this->myuserlikes = new ArrayCollection();
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
     * @return myUserProfile
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
     * Set user
     *
     * @param \Nfq\NomNomBundle\Entity\User $user
     * @return myUserProfile
     */
    public function setUser(\Nfq\NomNomBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Nfq\NomNomBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add myuserlikes
     *
     * @param \Nfq\NomNomBundle\Entity\myUserLikes $myuserlikes
     * @return myUserProfile
     */
    public function addMyuserlike(\Nfq\NomNomBundle\Entity\myUserLikes $myuserlikes)
    {
        $this->myuserlikes[] = $myuserlikes;

        return $this;
    }

    /**
     * Remove myuserlikes
     *
     * @param \Nfq\NomNomBundle\Entity\myUserLikes $myuserlikes
     */
    public function removeMyuserlike(\Nfq\NomNomBundle\Entity\myUserLikes $myuserlikes)
    {
        $this->myuserlikes->removeElement($myuserlikes);
    }

    /**
     * Get myuserlikes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyuserlikes()
    {
        return $this->myuserlikes;
    }
}
