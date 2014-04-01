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
     * @ORM\ManyToOne(targetEntity="myRoles", inversedBy="myUserEvents")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    private $myRole;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="myEvents", inversedBy="myUserEvents")
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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="myRecipeVotes", inversedBy="myuserevents")
     *
     */
    private $myrecipevote;

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

    /**
     * Set myRole
     *
     * @param \Nfq\NomNomBundle\Entity\myRoles $myRole
     * @return myUserEvents
     */
    public function setMyRole(\Nfq\NomNomBundle\Entity\myRoles $myRole = null)
    {
        $this->myRole = $myRole;

        return $this;
    }

    /**
     * Get myRole
     *
     * @return \Nfq\NomNomBundle\Entity\myRoles 
     */
    public function getMyRole()
    {
        return $this->myRole;
    }

    /**
     * Set myEvent
     *
     * @param \Nfq\NomNomBundle\Entity\myEvents $myEvent
     * @return myUserEvents
     */
    public function setMyEvent(\Nfq\NomNomBundle\Entity\myEvents $myEvent = null)
    {
        $this->myEvent = $myEvent;

        return $this;
    }

    /**
     * Get myEvent
     *
     * @return \Nfq\NomNomBundle\Entity\myEvents 
     */
    public function getMyEvent()
    {
        return $this->myEvent;
    }

    /**
     * Set myRecipeVote
     *
     * @param \Nfq\NomNomBundle\Entity\myRecipeVotes $myRecipeVote
     * @return myUserEvents
     */
    public function setMyRecipeVote(\Nfq\NomNomBundle\Entity\myRecipeVotes $myRecipeVote = null)
    {
        $this->myRecipeVote = $myRecipeVote;

        return $this;
    }

    /**
     * Get myRecipeVote
     *
     * @return \Nfq\NomNomBundle\Entity\myRecipeVotes 
     */
    public function getMyRecipeVote()
    {
        return $this->myRecipeVote;
    }

    /**
     * Set myUser
     *
     * @param \Nfq\NomNomBundle\Entity\User $myUser
     * @return myUserEvents
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
