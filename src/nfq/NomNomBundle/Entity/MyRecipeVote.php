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
     * @ORM\OneToMany(targetEntity="MyUserEvent", mappedBy="myRecipeVote")
     */
    private $myUserEvents;

    /**
     * @ORM\ManyToOne(targetEntity="MyRecipe", inversedBy="myRecipeVotes")
     * @ORM\JoinColumn(name="my_recipe_id", referencedColumnName="id")
     */
    private $myRecipe;

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
     * @return MyRecipeVote
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
     * Set myRecipe
     *
     * @param \Nfq\NomNomBundle\Entity\MyRecipe $myRecipe
     * @return MyRecipeVote
     */
    public function setMyRecipe(\Nfq\NomNomBundle\Entity\MyRecipe $myRecipe = null)
    {
        $this->myRecipe = $myRecipe;

        return $this;
    }

    /**
     * Get myRecipe
     *
     * @return \Nfq\NomNomBundle\Entity\MyRecipe 
     */
    public function getMyRecipe()
    {
        return $this->myRecipe;
    }
}
