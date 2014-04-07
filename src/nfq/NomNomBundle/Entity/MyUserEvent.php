<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyUserEvent
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyUserEventRepository")
 */
class MyUserEvent
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
     * @ORM\ManyToOne(targetEntity="MyUserProduct", inversedBy="myUserEvents")
     * @ORM\JoinColumn(name="my_user_product_id", referencedColumnName="id")
     */
    private $myUserProduct;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="MyRole", inversedBy="myUserEvents")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    private $myRole;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="MyEvent", inversedBy="myUserEvents")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $myEvent;

    /**
     * @var integer
     *
     * @ORM\Column(name="invitationStatus", type="smallint")
     */
    private $invitationStatus;

    /**
     * 0 for event creator
     * 1 for pending
     * 2 for accepted
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="MyRecipeVote", inversedBy="myUserEvents")
     * @ORM\JoinColumn(name="my_recipe_vote_id", referencedColumnName="id")
     */
    private $myRecipeVote;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="myUserEvents")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $myUser;

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
     * Set invitationStatus
     *
     * @param integer $invitationStatus
     * @return MyUserEvent
     */
    public function setInvitationStatus($invitationStatus)
    {
        $this->invitationStatus = $invitationStatus;

        return $this;
    }

    /**
     * Get invitationStatus
     *
     * @return integer 
     */
    public function getInvitationStatus()
    {
        return $this->invitationStatus;
    }

    /**
     * Set myUserProduct
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserProduct $myUserProduct
     * @return MyUserEvent
     */
    public function setMyUserProduct(\Nfq\NomNomBundle\Entity\MyUserProduct $myUserProduct = null)
    {
        $this->myUserProduct = $myUserProduct;

        return $this;
    }

    /**
     * Get myUserProduct
     *
     * @return \Nfq\NomNomBundle\Entity\MyUserProduct 
     */
    public function getMyUserProduct()
    {
        return $this->myUserProduct;
    }

    /**
     * Set myRole
     *
     * @param \Nfq\NomNomBundle\Entity\MyRole $myRole
     * @return MyUserEvent
     */
    public function setMyRole(\Nfq\NomNomBundle\Entity\MyRole $myRole = null)
    {
        $this->myRole = $myRole;

        return $this;
    }

    /**
     * Get myRole
     *
     * @return \Nfq\NomNomBundle\Entity\MyRole 
     */
    public function getMyRole()
    {
        return $this->myRole;
    }

    /**
     * Set myEvent
     *
     * @param \Nfq\NomNomBundle\Entity\MyEvent $myEvent
     * @return MyUserEvent
     */
    public function setMyEvent(\Nfq\NomNomBundle\Entity\MyEvent $myEvent = null)
    {
        $this->myEvent = $myEvent;

        return $this;
    }

    /**
     * Get myEvent
     *
     * @return \Nfq\NomNomBundle\Entity\MyEvent 
     */
    public function getMyEvent()
    {
        return $this->myEvent;
    }

    /**
     * Set myRecipeVote
     *
     * @param \Nfq\NomNomBundle\Entity\myRecipeVote $myRecipeVote
     * @return MyUserEvent
     */
    public function setMyRecipeVote(\Nfq\NomNomBundle\Entity\myRecipeVote $myRecipeVote = null)
    {
        $this->myRecipeVote = $myRecipeVote;

        return $this;
    }

    /**
     * Get myRecipeVote
     *
     * @return \Nfq\NomNomBundle\Entity\myRecipeVote 
     */
    public function getMyRecipeVote()
    {
        return $this->myRecipeVote;
    }

    /**
     * Set myUser
     *
     * @param \Nfq\NomNomBundle\Entity\User $myUser
     * @return MyUserEvent
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
