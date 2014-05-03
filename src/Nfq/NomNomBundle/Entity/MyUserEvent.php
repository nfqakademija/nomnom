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
     * @ORM\OneToMany(targetEntity="MyUserProduct", mappedBy="myUserEvent")
     */
    private $myUserProducts;

    /**
     * @ORM\OneToMany(targetEntity="MyNotification", mappedBy="myUserEvent")
     */
    private $myNotifications;

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
     * @var integer
     *
     * @ORM\Column(name="ready_to_phase_two", type="smallint")
     */
    private $readyToPhaseTwo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ready_to_phase_three", type="smallint")
     */
    private $readyToPhaseThree;


    /**
     * 0 for event creator
     * 1 for pending
     * 2 for accepted
     *
     * @ORM\OneToMany(targetEntity="MyRecipeVote", mappedBy="myUserEvent")
     */
    private $myRecipeVotes;

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

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myUserProducts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myRecipeVotes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add myUserProducts
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts
     * @return MyUserEvent
     */
    public function addMyUserProduct(\Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts)
    {
        $this->myUserProducts[] = $myUserProducts;

        return $this;
    }

    /**
     * Remove myUserProducts
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts
     */
    public function removeMyUserProduct(\Nfq\NomNomBundle\Entity\MyUserProduct $myUserProducts)
    {
        $this->myUserProducts->removeElement($myUserProducts);
    }

    /**
     * Get myUserProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyUserProducts()
    {
        return $this->myUserProducts;
    }

    /**
     * Add myRecipeVotes
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeVote $myRecipeVotes
     * @return MyUserEvent
     */
    public function addMyRecipeVote(\Nfq\NomNomBundle\Entity\MyRecipeVote $myRecipeVotes)
    {
        $this->myRecipeVotes[] = $myRecipeVotes;

        return $this;
    }

    /**
     * Remove myRecipeVotes
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipeVote $myRecipeVotes
     */
    public function removeMyRecipeVote(\Nfq\NomNomBundle\Entity\MyRecipeVote $myRecipeVotes)
    {
        $this->myRecipeVotes->removeElement($myRecipeVotes);
    }

    /**
     * Get myRecipeVotes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyRecipeVotes()
    {
        return $this->myRecipeVotes;
    }

    /**
     * Set readyToPhaseTwo
     *
     * @param integer $readyToPhaseTwo
     * @return MyUserEvent
     */
    public function setReadyToPhaseTwo($readyToPhaseTwo)
    {
        $this->readyToPhaseTwo = $readyToPhaseTwo;

        return $this;
    }

    /**
     * Get readyToPhaseTwo
     *
     * @return integer
     */
    public function getReadyToPhaseTwo()
    {
        return $this->readyToPhaseTwo;
    }

    /**
     * Set readyToPhaseThree
     *
     * @param integer $readyToPhaseThree
     * @return MyUserEvent
     */
    public function setReadyToPhaseThree($readyToPhaseThree)
    {
        $this->readyToPhaseThree = $readyToPhaseThree;

        return $this;
    }

    /**
     * Get readyToPhaseThree
     *
     * @return integer
     */
    public function getReadyToPhaseThree()
    {
        return $this->readyToPhaseThree;
    }

    /**
     * Add myNotifications
     *
     * @param \Nfq\NomNomBundle\Entity\MyNotification $myNotifications
     * @return MyUserEvent
     */
    public function addMyNotification(\Nfq\NomNomBundle\Entity\MyNotification $myNotifications)
    {
        $this->myNotifications[] = $myNotifications;

        return $this;
    }

    /**
     * Remove myNotifications
     *
     * @param \Nfq\NomNomBundle\Entity\MyNotification $myNotifications
     */
    public function removeMyNotification(\Nfq\NomNomBundle\Entity\MyNotification $myNotifications)
    {
        $this->myNotifications->removeElement($myNotifications);
    }

    /**
     * Get myNotifications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMyNotifications()
    {
        return $this->myNotifications;
    }
}
