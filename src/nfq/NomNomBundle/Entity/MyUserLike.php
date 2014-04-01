<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyUserLike
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyUserLikeRepository")
 */
class MyUserLike
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
     * @var string
     *
     * @ORM\Column(name="food", type="string", length=50)
     */
    private $food;

    /**
     * Zero for dislikes and one for likes
     * @var boolean
     *
     * @ORM\Column(name="LikeOrDislike", type="boolean")
     */
    private $likeOrDislike;

    /**
     * @ORM\ManyToOne(targetEntity="MyUserProfile",inversedBy="myUserLikes")
     * @ORM\JoinColumn(name="my_user_profile_id",referencedColumnName="id")
     */
    private $myUserProfile;

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
     * Set food
     *
     * @param string $food
     * @return MyUserLike
     */
    public function setFood($food)
    {
        $this->food = $food;

        return $this;
    }

    /**
     * Get food
     *
     * @return string 
     */
    public function getFood()
    {
        return $this->food;
    }

    /**
     * Set likeOrDislike
     *
     * @param boolean $likeOrDislike
     * @return MyUserLike
     */
    public function setLikeOrDislike($likeOrDislike)
    {
        $this->likeOrDislike = $likeOrDislike;

        return $this;
    }

    /**
     * Get likeOrDislike
     *
     * @return boolean 
     */
    public function getLikeOrDislike()
    {
        return $this->likeOrDislike;
    }

    /**
     * Set myUserProfile
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserProfile $myUserProfile
     * @return MyUserLike
     */
    public function setMyUserProfile(\Nfq\NomNomBundle\Entity\MyUserProfile $myUserProfile = null)
    {
        $this->myUserProfile = $myUserProfile;

        return $this;
    }

    /**
     * Get myUserProfile
     *
     * @return \Nfq\NomNomBundle\Entity\MyUserProfile 
     */
    public function getMyUserProfile()
    {
        return $this->myUserProfile;
    }
}
