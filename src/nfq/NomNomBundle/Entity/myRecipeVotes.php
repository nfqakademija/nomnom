<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * myRecipeVotes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Nfq\NomNomBundle\Entity\myRecipeVotesRepository")
 */
class myRecipeVotes
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
     * @ORM\Column(name="recipeId", type="integer")
     */
    private $recipeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="vote", type="smallint")
     */
    private $vote;

    /**
     * @ORM\OneToMany(targetEntity="myUserEvents", mappedBy="myrecipevote")
     */
    private $myuserevents;

    /**
     * @ORM\ManyToOne(targetEntity="myRecipes", inversedBy="myrecipesvotes")
     *
     */
    private $myrecipes;

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
     * Set recipeId
     *
     * @param integer $recipeId
     * @return myRecipeVotes
     */
    public function setRecipeId($recipeId)
    {
        $this->recipeId = $recipeId;

        return $this;
    }

    /**
     * Get recipeId
     *
     * @return integer 
     */
    public function getRecipeId()
    {
        return $this->recipeId;
    }

    /**
     * Set vote
     *
     * @param integer $vote
     * @return myRecipeVotes
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
     * @param \Nfq\NomNomBundle\Entity\myUserEvents $myUserEvents
     * @return myRecipeVotes
     */
    public function addMyUserEvent(\Nfq\NomNomBundle\Entity\myUserEvents $myUserEvents)
    {
        $this->myUserEvents[] = $myUserEvents;

        return $this;
    }

    /**
     * Remove myUserEvents
     *
     * @param \Nfq\NomNomBundle\Entity\myUserEvents $myUserEvents
     */
    public function removeMyUserEvent(\Nfq\NomNomBundle\Entity\myUserEvents $myUserEvents)
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
}
