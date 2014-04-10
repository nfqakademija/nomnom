<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyRecipeVote
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\MyRecipeVoteRepository")
 */
class MyRecipeVote
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
     * @ORM\Column(name="vote", type="smallint")
     */
    private $vote;

    /**
     * @ORM\ManyToOne(targetEntity="MyUserEvent", inversedBy="myRecipeVotes")
     * @ORM\JoinColumn(name="my_user_event_id", referencedColumnName="id")
     */
    private $myUserEvent;

    /**
     * @ORM\ManyToOne(targetEntity="MyEventRecipe", inversedBy="myRecipeVotes")
     * @ORM\JoinColumn(name="my_event_recipe_id", referencedColumnName="id")
     */
    private $myEventRecipe;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myUserEvents = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set vote
     *
     * @param integer $vote
     * @return MyRecipeVote
     */
    public function setVote($vote)
    {
        $this->vote = $vote;

        return $this;
    }

    /**
     * Get vote
     *
     * @return integer 
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * Add myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents
     * @return MyRecipeVote
     */
    public function addMyUserEvent(\Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents)
    {
        $this->myUserEvents[] = $myUserEvents;

        return $this;
    }

    /**
     * Remove myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents
     */
    public function removeMyUserEvent(\Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvents)
    {
        $this->myUserEvents->removeElement($myUserEvents);
    }

    /**
     * Get myUserEvents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyUserEvents()
    {
        return $this->myUserEvents;
    }

    /**
     * Set myUserEvent
     *
     * @param \Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvent
     * @return MyRecipeVote
     */
    public function setMyUserEvent(\Nfq\NomNomBundle\Entity\MyUserEvent $myUserEvent = null)
    {
        $this->myUserEvent = $myUserEvent;

        return $this;
    }

    /**
     * Get myUserEvent
     *
     * @return \Nfq\NomNomBundle\Entity\MyUserEvent 
     */
    public function getMyUserEvent()
    {
        return $this->myUserEvent;
    }

    /**
     * Set myEventRecipe
     *
     * @param \Nfq\NomNomBundle\Entity\MyEventRecipe $myEventRecipe
     * @return MyRecipeVote
     */
    public function setMyEventRecipe(\Nfq\NomNomBundle\Entity\MyEventRecipe $myEventRecipe = null)
    {
        $this->myEventRecipe = $myEventRecipe;

        return $this;
    }

    /**
     * Get myEventRecipe
     *
     * @return \Nfq\NomNomBundle\Entity\MyEventRecipe 
     */
    public function getMyEventRecipe()
    {
        return $this->myEventRecipe;
    }
}
