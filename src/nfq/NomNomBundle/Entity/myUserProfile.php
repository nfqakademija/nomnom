<?php

namespace Nfq\NomNomBundle\Entity;

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
     * @var integer
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="userLikesId", type="integer")
     */
    private $userLikesId;

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
     * Set userId
     *
     * @param integer $userId
     * @return myUserProfile
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userLikesId
     *
     * @param integer $userLikesId
     * @return myUserProfile
     */
    public function setUserLikesId($userLikesId)
    {
        $this->userLikesId = $userLikesId;

        return $this;
    }

    /**
     * Get userLikesId
     *
     * @return integer 
     */
    public function getUserLikesId()
    {
        return $this->userLikesId;
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
}
