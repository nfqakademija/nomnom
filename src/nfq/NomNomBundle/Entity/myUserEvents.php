<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * myUserEvents
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myUserEventsRepository")
 */
class myUserEvents
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
     * @ORM\ManyToOne(targetEntity="myUserProducts", inversedBy="myuserevents")
     * @ORM\JoinColumn(name="myuserproducts_id", referencedColumnName="id")
     */
    private $myuserproducts;
    /**
     * @var integer
     *
     * @ORM\Column(name="roleId", type="integer")
     */
    private $roleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="eventId", type="integer")
     */
    private $eventId;

    /**
     * @var integer
     *
     * @ORM\Column(name="invitationStatus", type="smallint")
     */
    private $invitationStatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="recipeVoteId", type="integer")
     */
    private $recipeVoteId;

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
     * Set roleId
     *
     * @param integer $roleId
     * @return myUserEvents
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return integer 
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return myUserEvents
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
     * Set eventId
     *
     * @param integer $eventId
     * @return myUserEvents
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return integer 
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set invitationStatus
     *
     * @param integer $invitationStatus
     * @return myUserEvents
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
     * Set recipeVoteId
     *
     * @param integer $recipeVoteId
     * @return myUserEvents
     */
    public function setRecipeVoteId($recipeVoteId)
    {
        $this->recipeVoteId = $recipeVoteId;

        return $this;
    }

    /**
     * Get recipeVoteId
     *
     * @return integer 
     */
    public function getRecipeVoteId()
    {
        return $this->recipeVoteId;
    }

    /**
     * Set myuserproducts
     *
     * @param \Nfq\NomNomBundle\Entity\myUserProducts $myuserproducts
     * @return myUserEvents
     */
    public function setMyuserproducts(\Nfq\NomNomBundle\Entity\myUserProducts $myuserproducts = null)
    {
        $this->myuserproducts = $myuserproducts;

        return $this;
    }

    /**
     * Get myuserproducts
     *
     * @return \Nfq\NomNomBundle\Entity\myUserProducts 
     */
    public function getMyuserproducts()
    {
        return $this->myuserproducts;
    }
}
