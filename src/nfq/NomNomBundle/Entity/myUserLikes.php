<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * myUserLikes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myUserLikesRepository")
 */
class myUserLikes
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
     * @var boolean
     *
     * @ORM\Column(name="LikeOrDislike", type="boolean")
     */
    private $likeOrDislike;


    /**
     * @ORM\ManyToOne(targetEntity="myUserProfile",inversedBy="myuserlikes")
     * @ORM\JoinColumn(name="myuserprofile_id",referencedColumnName="id")
     */
    private $myuserprofile;

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
     * @return myUserLikes
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
     * @return myUserLikes
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
     * Set myuserprofile
     *
     * @param \Nfq\NomNomBundle\Entity\myUserProfile $myuserprofile
     * @return myUserLikes
     */
    public function setMyuserprofile(\Nfq\NomNomBundle\Entity\myUserProfile $myuserprofile = null)
    {
        $this->myuserprofile = $myuserprofile;

        return $this;
    }

    /**
     * Get myuserprofile
     *
     * @return \Nfq\NomNomBundle\Entity\myUserProfile 
     */
    public function getMyuserprofile()
    {
        return $this->myuserprofile;
    }
}
